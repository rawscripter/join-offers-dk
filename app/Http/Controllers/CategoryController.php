<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubCategoryResource;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
            $categories = Category::where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
            $total = Category::where('name', 'like', '%' . $request['query'] . '%')->get();
        } elseif ($request->orderBy) {
            $categories = Category::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
            $total = Category::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->get();
        } else {
            $categories = Category::paginate($request->limit ? $request->limit : 20);
            $total = Category::all();
        }

        $res['total'] = $total->count();
        $res['categories'] = CategoryResource::collection($categories);

        return response()->json($res);
    }

    public function products($categorySlug, Request $request)
    {
        $category = Category::where('slug', $categorySlug)->first();

        if (!empty($category)) {
            $res['status'] = 200;
            $res['message'] = 'Category Found Successfully.';

            if ($request['gender'] || $request['short'] || $request['minPrice'] || $request['maxPrice']) {
                $gender = $_GET['gender'];
                $short = $_GET['short'];
                $minPrice = $_GET['minPrice'];
                $maxPrice = $_GET['maxPrice'];
                $subCategory = $_GET['subCategory'] ?? null;
                $products = Product::query();

                $products->where('category_id', $category->id);


                if ($short === 'expired') {
                    $products->where('expire_date', '<', Carbon::now());
                } else if ($short === 'coming_soon') {
                    $products->where('offer_start_date', '>', Carbon::now());
                } else {
                    $products->where('expire_date', '>', Carbon::now());
                }


                if (!empty($subCategory)) {
                    $products->where('sub_category_id', $subCategory);
                }

                // to filter the gender
                if (strtolower($gender) != 'all') {
                    $products->where('product_type', 'like', "%\"{$gender}\"%");
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
            } else {
                $products = Product::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(6);
            }

            $res['products'] = ProductResource::collection($products);
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    public function subCategoriesForSite($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        if (!empty($category)) {
            $res['status'] = 200;
            $res['message'] = 'Category Found Successfully.';
            $res['subCategories'] = SubCategoryResource::collection($category->subCategories);
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
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
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;
        $category = Category::create($data);

        if ($category) {
            $res['status'] = 200;
            $res['message'] = 'Category Created Successfully.';
            $res['data'] = (new CategoryResource($category));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        if (!empty($category)) {
            $res['status'] = 200;
            $res['message'] = 'Category Found Successfully.';
            $res['category'] = (new CategoryResource($category));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['icon'] = $request->icon;

        $data['slug'] = Str::slug($request->name);

        if ($category->update($data)) {
            $res['status'] = 200;
            $res['message'] = 'Category Updated Successfully.';
            $res['data'] = (new CategoryResource($category));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {

        if ($category->delete()) {
            $res['status'] = 200;
            $res['message'] = 'Category Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }


    public function subCategories(Category $category)
    {
        if ($category) {
            $res['status'] = 200;
            $res['message'] = 'Category Deleted Successfully.';
            $res['subCategories'] = SubCategoryResource::collection($category->subCategories);
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        echo json_encode($res);
    }
}
