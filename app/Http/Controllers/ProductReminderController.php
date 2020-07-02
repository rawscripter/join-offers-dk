<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Http\Resources\ProductResource;
use App\Product;
use App\ProductReminder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $slug
     * @return JsonResponse
     */
    public function store(Request $request, $slug)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $product = Product::where('slug', $slug)->first();
            if (!empty($product)) {
                $isAddedBefore = ProductReminder::where('user_id', $user->id)->where('product_id', $product->id)->first();
                if (!$isAddedBefore) {
                    $res['status'] = 200;
                    $res['message'] = 'Added To Reminder List.';
                    ProductReminder::create([
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'product_id' => $product->id
                    ]);
                } else {
                    $res['status'] = 200;
                    $res['message'] = 'Added To Reminder List.';
                }

            } else {
                $res['status'] = 201;
                $res['message'] = 'No Product Found';
            }
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductReminder $productReminder
     * @return void
     */
    public function show(ProductReminder $productReminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductReminder $productReminder
     * @return void
     */
    public function edit(ProductReminder $productReminder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProductReminder $productReminder
     * @return Response
     */
    public function update(Request $request, ProductReminder $productReminder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductReminder $productReminder
     * @return Response
     */
    public function destroy(ProductReminder $productReminder)
    {
        //
    }
}
