<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\VehicleResource;
use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return VehicleResource::collection(Vehicle::orderBy('name')->where('user_id', $request->user()->id)->get());
    }

    public function show(Request $request, Vehicle $vehicle)
    {
        return  new VehicleResource($vehicle);
    }

    public function create(VehicleRequest $request)
    {
        $vehicle = Vehicle::create([
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'owner_email' => $request->input('owner_email'),
        ]);

        if ($request->labels) {
            $vehicle->labels()->attach($request->labels);
        }

        return response(['id' => $vehicle->id]);
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            abort(404);
        }

        $vehicle->update([
            'name' => $request->input('name'),
            'owner_email' => $request->input('owner_email')
        ]);

        if ($request->labels) {
            $vehicle->labels()->sync($request->labels);
        } else {
            $vehicle->labels()->detach();
        }
        return response(['updated' => true]);
    }

    public function delete(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            abort(404);
        }

        $vehicle->delete();
        return response(['deleted' => true]);
    }
}
