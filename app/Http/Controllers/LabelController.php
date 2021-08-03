<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\LabelResource;
use App\Models\Label;

class LabelController extends Controller
{
    public function index(Request $request)
    {
        return LabelResource::collection( Label::orderBy('name')->get() );
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:labels|max:255',
        ]);

        $label = Label::create(['name' =>  $request->input('name')]);
        return response(['label' => new LabelResource($label) ]);
    }

    public function delete(Request $request, Label $label)
    {
        if ($label->vehicles->count() > 0 ||  $label->checkSheets->count() > 0) {
            abort(404);
        }

        $label->delete();
        return response(['deleted' => true]);
    }
}
