<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rui' => base64_encode($this->id),
            'run' => base64_encode($this->name),
            'url' => base64_encode($this->role),
        ];
    }
}
