<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Like;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request['query']) {
            $products = Product::where('is_archive', 0)->where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 0)->where('name', 'like', '%' . $request['query'] . '%')->get();
        } elseif ($request->orderBy) {
            $products = Product::where('is_archive', 0)->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 0)->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->get();
        } else {
            $products = Product::where('is_archive', 0)->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 0)->get();
        }
        $res['total'] = $total->count();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function archiveProducts(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request['query']) {
            $products = Product::where('is_archive', 1)->where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 1)->where('name', 'like', '%' . $request['query'] . '%')->get();
        } elseif ($request->orderBy) {
            $products = Product::where('is_archive', 1)->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 1)->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->get();
        } else {
            $products = Product::where('is_archive', 1)->paginate($request->limit ? $request->limit : 20);
            $total = Product::where('is_archive', 1)->get();
        }
        $res['total'] = $total->count();
        $res['products'] = ProductResource::collection($products);
        return response()->json($res);
    }

    public function productsForSite(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        if ($request['gender'] || $request['short'] || $request['minPrice'] || $request['maxPrice']) {
            $gender = $_GET['gender'];
            $short = $_GET['short'];
            $minPrice = $_GET['minPrice'];
            $maxPrice = $_GET['maxPrice'];
            $products = Product::query();
            // to filter the gender
            if (strtolower($gender) != 'all') {
                $products->where('product_type', $gender);
            }
            // to filter the price
            $products->whereBetween('offer_price', [$minPrice, $maxPrice]);
            // to order the product
            if (strtolower($short) === 'new') {
                $products->orderByDesc('created_at');
            }

            if (strtolower($short) === 'popular') {
                $products->orderByDesc('total_clicks');
            }

            if (strtolower($short) === 'old') {
                $products->where('expire_date', '>', Carbon::now());
                $products->where('expire_date', '<', Carbon::now()->addDays(1));
            }

            $products = $products->paginate(6);

        } else if (isset($request['query']) && !empty($request['query'])) {
            $products = Product::where('name', 'like', '%' . $request['query'] . '%')->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $products = Product::orderBy('created_at', 'desc')->paginate(6);
        }
        $res['products'] = ProductResource::collection($products);
        $res['lastPage'] = $res['products']->lastPage();
        return response()->json($res);
    }

    public function userFavouriteProductsForSite(Request $request)
    {

        $user = Auth::guard('api')->user();

        if ($user) {
            $res['status'] = 200;
            $res['message'] = 'All Categories';
            $products = $user->likedProducts;
            $res['products'] = ProductResource::collection($products);
            $res['lastPage'] = 1;
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }


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
        $this->validateRequest($request);

        $data = $this->convertRequestProductDataToArray($request);
        // set product current Price
        $data['current_price'] = $data['offer_price'];

        $data['event_id'] = $this->generateEventId(8);

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
            // increment product click
            $product->increment('total_clicks');
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
        $this->validateRequest($request);

        $data = $this->convertRequestProductDataToArray($request);
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
        if ($product) {
            $product->is_archive = 1;
            $product->save();
            $res['status'] = 200;
            $res['message'] = 'Product Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function restore(Product $product)
    {
        if ($product) {
            $product->is_archive = 0;
            $product->save();
            $res['status'] = 200;
            $res['message'] = 'Product Restored Successfully.';
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

    public function addToFavourite($slug)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $product = Product::where('slug', $slug)->first();
            if (!empty($product)) {
                if (!$product->isAuthUserLikedPost()) {
                    $res['status'] = 200;
                    $res['message'] = 'Product added to favourite list.';
                    $product->total_favourites = $product->total_favourites + 1;
                    $product->save();
                    Like::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id
                    ]);
                    $res['product'] = (new ProductResource($product));
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

    public function removeFromFavourite($slug)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $product = Product::where('slug', $slug)->first();
            if (!empty($product)) {
                if ($product->isAuthUserLikedPost()) {
                    $res['status'] = 200;
                    $res['message'] = 'Product removed to favourite list.';
                    $product->total_favourites = $product->total_favourites - 1;
                    $product->save();
                    Like::where('user_id', $user->id)->where('product_id', $product->id)->delete();
                    $res['product'] = (new ProductResource($product));
                } else {
                    $res['status'] = 201;
                    $res['message'] = 'Not Liked Yet';
                }
            } else {
                $res['status'] = 201;
                $res['message'] = 'No Category Found';
            }
        } else {
            $res['status'] = 201;
            $res['message'] = 'Please login first.';
        }
        return response()->json($res);
    }

    public function convertRequestProductDataToArray($request)
    {
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['short_des'] = $request->short_des;
        $data['full_des'] = $request->full_des;
        $data['category_id'] = $request->category_id;
        $data['sub_category_id'] = $request->sub_category_id;
        $data['market_price'] = $request->market_price;
        $data['offer_price'] = $request->offer_price;
        $data['last_price'] = $request->last_price;
        $data['join_price'] = $request->join_price;
        $data['product_type'] = $request->product_type;
        $data['total_offer_spots'] = $request->total_offer_spots;
        $data['minus_price_user_price'] = $request->minus_price_user_price;
        $data['max_unit_per_user'] = $request->max_unit_per_user;
        $data['user_id'] = auth()->user()->id;
        $data['expire_date'] = Carbon::parse($request->expire_date)->format('Y-m-d H:s:i');
        return $data;
    }

    public function validateRequest($request)
    {
        return $request->validate([
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
            'product_type' => 'required'
        ]);
    }

    public function generateEventId($length = 20)
    {
        $characters = '0123456789_ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
