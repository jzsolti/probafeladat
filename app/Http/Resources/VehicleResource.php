<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource, App\Http\Resources\CheckSheetResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' =>  new UserResource($this->user),
            'name' => $this->name,
            'owner_email' => $this->owner_email,
            'check_sheets' => CheckSheetResource::collection( $this->checkSeets ),
        ];
    }
}
