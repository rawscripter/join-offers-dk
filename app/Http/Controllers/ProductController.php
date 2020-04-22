<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request['query']) {
            $products = Product::where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('name', 'like', '%' . $request['query'] . '%')->get();
        } elseif ($request->orderBy) {
            $products = Product::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
            $total = Product::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->get();
        } else {
            $products = Product::paginate($request->limit ? $request->limit : 20);
            $total = Product::all();
        }
        $res['total'] = $total->count();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function productsForSite(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';

        if ($request['query']) {
            $products = Product::where('name', 'like', '%' . $request['query'] . '%')->paginate(6);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(6);
        }

        $res['products'] = ProductResource::collection($products);
        $res['products'] = ProductResource::collection($products);
        $res['lastPage'] = $res['products']->lastPage();
        return response()->json($res);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // to upload product image
        $request->validate([
            'name' => 'required|unique:categories',
            'short_des' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'market_price' => 'required',
            'offer_price' => 'required',
            'last_price' => 'required',
            'total_offer_spots' => 'required',
            'minus_price_user_price' => 'required',
            'expire_date' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['short_des'] = $request->short_des;
        $data['full_des'] = $request->full_des;
        $data['category_id'] = $request->category_id;
        $data['sub_category_id'] = $request->sub_category_id;
        $data['market_price'] = $request->market_price;
        $data['offer_price'] = $request->offer_price;
        $data['last_price'] = $request->last_price;
        $data['total_offer_spots'] = $request->total_offer_spots;
        $data['minus_price_user_price'] = $request->minus_price_user_price;
        $data['user_id'] = auth()->user()->id;
        $data['expire_date'] = Carbon::parse($request->expire_date)->format('Y-m-d H:s:i');
        if ($request->product_image)
            $data['image'] = ImageController::uploadImage($request->product_image);
        $product = Product::create($data);
        // to upload product image
        if ($request->product_image) {
            $product->productImages()->create(
                [
                    'user_id' => auth()->user()->id,
                    'image' => $data['image'],
                ]
            );
        }

        if ($product) {
            $res['status'] = 200;
            $res['message'] = 'Product Created Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        if (!empty($product)) {
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function showProductForSite($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!empty($product)) {
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRelatedForSite($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('category_id', $product->category->id)->where('id', '!=', $product->id)->limit(3)->get();
        if (!empty($products)) {
            $res['status'] = 200;
            $res['message'] = 'Product Found Successfully.';
            $res['relatedProducts'] = ProductResource::collection($products);
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'short_des' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'market_price' => 'required',
            'offer_price' => 'required',
            'last_price' => 'required',
            'total_offer_spots' => 'required',
            'minus_price_user_price' => 'required',
            'expire_date' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['short_des'] = $request->short_des;
        $data['full_des'] = $request->full_des;
        $data['category_id'] = $request->category_id;
        $data['sub_category_id'] = $request->sub_category_id;
        $data['market_price'] = $request->market_price;
        $data['offer_price'] = $request->offer_price;
        $data['last_price'] = $request->last_price;
        $data['total_offer_spots'] = $request->total_offer_spots;
        $data['minus_price_user_price'] = $request->minus_price_user_price;
        $data['user_id'] = auth()->user()->id;
        $data['expire_date'] = Carbon::parse($request->expire_date)->format('Y-m-d H:s:i');

        // to upload product image
        if ($request->product_image)
            $data['image'] = ImageController::uploadImage($request->product_image);


        if ($request->product_image) {
            $product->productImages()->create(
                [
                    'user_id' => auth()->user()->id,
                    'image' => $data['image'],
                ]
            );
        }


        if ($product->update($data)) {
            $res['status'] = 200;
            $res['message'] = 'Product Updated Successfully.';
            $res['product'] = (new ProductResource($product));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            $res['status'] = 200;
            $res['message'] = 'Product Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function deleteProductImage($image)
    {
        $productImage = ProductImage::find($image);
        if ($productImage) {
            $productImage->delete();
            $res['status'] = 200;
            $res['message'] = 'Product Image Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Image Found';
        }
        return response()->json($res);
    }

    public function uploadProductImages(Product $product, Request $request)
    {
        if ($request->hasFile('file')) {
            $image = ImageController::uploadImage($request->file);
            $product->productImages()->create(
                [
                    'image' => $image,
                    'user_id' => auth()->user()->id
                ]
            );
        }
    }
}
