<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CheckSheetResource;
use App\Http\Requests\CheckSheetRequest;
use App\Models\CheckSheet, App\Models\Vehicle;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckSheetCreated;

class CheckSheetController extends Controller
{
    public function index(Request $request)
    {

        $vehicleIds = Vehicle::select('id')->where('user_id', $request->user()->id)->get()/*->pluck('id')*/->toArray();

        return CheckSheetResource::collection(CheckSheet::orderBy('name')->where('vehicle_id', $vehicleIds)->get());
    }

    public function show(Request $request, CheckSheet $checkSheet)
    {
        if ($checkSheet->vehicle->user_id !== $request->user()->id) {
            abort(404);
        }
        
        return  new CheckSheetResource($checkSheet);
    }

    public function create(CheckSheetRequest $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            abort(404);
        }

        $checkSheet = CheckSheet::create([
            'vehicle_id' =>  $vehicle->id,
            'vehicle_name' => $vehicle->name,
            'job' => $request->input('job'),
            'comment' => $request->input('comment')
        ]);

        if ($request->labels) {
            $checkSheet->labels()->attach($request->labels);
        }

        try {
            //  email
         Mail::to($vehicle->owner_email)->send(new CheckSheetCreated($checkSheet));
        } catch (\Exception $e) {
            report($e);
        }

        return response(['id' => $checkSheet->id]);
    }

    public function update(CheckSheetRequest $request, CheckSheet $checkSheet)
    {
        if ($checkSheet->vehicle->user_id !== $request->user()->id) {
            abort(404);
        }

        if ($request->labels) {
            $checkSheet->labels()->sync($request->labels);
        } else {
            $checkSheet->labels()->detach();
        }

        $checkSheet->update([
            'job' => $request->input('job'),
            'comment' => $request->input('comment')
        ]);
        return response(['updated' => true]);
    }

    public function delete(Request $request, CheckSheet $checkSheet)
    {
        if ($checkSheet->vehicle->user_id !== $request->user()->id) {
            abort(404);
        }

        $checkSheet->delete();
        return response(['deleted' => true]);
    }
}
