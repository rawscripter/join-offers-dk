<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d F Y'),
            'userId' => $this->user->id,
            'total_products' => $this->runningProducts->count(),
            'user' => $this->user->name
        ];
    }
}
