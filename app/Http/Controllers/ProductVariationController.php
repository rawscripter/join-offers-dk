<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductVariation;
use App\ProductVariationOption;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Product $product, Request $request)
    {
        $res['status'] = 200;
        $res['variation'] = ProductVariation::create([
            'product_id' => $product->id,
            'name' => $request->variation,
        ]);

        return response()->json($res);
    }

    public function addOption(Product $product, Request $request)
    {
        $res['status'] = 200;
        $res['variationOption'] = ProductVariationOption::create([
            'product_id' => $product->id,
            'product_variation_id' => $request->variation_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return response()->json($res);
    }

    public function deleteVariationOption(ProductVariationOption $productVariationOption)
    {
        try {
            if ($productVariationOption->delete()) {
                $res['status'] = 200;

            } else {
                $res['status'] = 201;
            }
        } catch (\Exception $e) {
            $res['status'] = 201;
        }

        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProductVariation $productVariation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariation $productVariation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProductVariation $productVariation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariation $productVariation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariation $productVariation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariation $productVariation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProductVariation $productVariation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProductVariation $productVariation)
    {
        try {

            if ($productVariation->delete()) {
                $res['status'] = 200;

            } else {
                $res['status'] = 201;
            }
        } catch (\Exception $e) {
            $res['status'] = 201;
        }

        return response()->json($res);
    }
}
