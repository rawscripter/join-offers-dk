<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
            'categoryId' => $this->category->id,
            'priority' => $this->priority,
            'categoryName' => $this->category->name,
            'userId' => $this->user->id,
            'user' => $this->user->name,
            'created_at' => $this->created_at->format('d F Y')
        ];
    }
}
