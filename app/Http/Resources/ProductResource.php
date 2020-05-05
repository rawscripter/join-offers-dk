<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'slug' => $this->slug,
            'product_type' => $this->product_type,
            'thumbImage' => $this->thumbImage(),
            'featureImage' => $this->featureImage(),
            'fullImage' => $this->mainImage(),
            'productImages' => ProductImageResource::collection($this->productImages),
            'total_favourites' => $this->likes->count(),
            'isLikedByCurrentUser' => $this->isAuthUserLikedPost(),
            'short_des' => $this->short_des,
            'full_des' => $this->full_des,
            'category' => $this->category->name,
            'categoryData' => $this->category,
            'subCategory' => $this->subCategory->name,
            'subCategoryData' => $this->subCategory,
            'market_price' => $this->market_price,
            'current_price' => $this->current_price,
            'saving_percentage' => $this->savingPercentage(),
            'is_join_payment_required' => $this->join_price > 0 ? true : false,
            'join_price' => $this->join_price,
            'join_payment_percentage' => $this->paymentPercentage(),
            'offer_price' => $this->offer_price,
            'last_price' => $this->last_price,
            'total_offer_spots' => $this->total_offer_spots,
            'minus_price_user_price' => $this->minus_price_user_price,
            'user' => $this->user->name,
            'expire_date' => Carbon::parse($this->expire_date)->format('d F Y H:i:s'),
            'expire_date_timestamp' => Carbon::parse($this->expire_date)->format('Y-m-d\TH:i'),
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}
