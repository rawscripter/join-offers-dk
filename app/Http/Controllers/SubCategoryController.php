<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubCategoryResource;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
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
            $categories = SubCategory::where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
            $total = SubCategory::where('name', 'like', '%' . $request['query'] . '%')->get();
        } elseif ($request->orderBy) {
            $categories = SubCategory::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
            $total = SubCategory::orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->get();
        } else {
            $categories = SubCategory::paginate($request->limit ? $request->limit : 20);
            $total = SubCategory::all();
        }

        $res['total'] = $total->count();
        $res['subCategories'] = SubCategoryResource::collection($categories);

        return response()->json($res);
    }

    public function products($subCategorySlug)
    {
        $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
        if (!empty($subCategory)) {
            $res['status'] = 200;
            $res['message'] = 'Category Found Successfully.';
            $res['products'] = ProductResource::collection($subCategory->products);
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
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;
        $data['category_id'] = $request->category_id;
        $data['priority'] = $request->priority;

        $subCategory = SubCategory::create($data);
        if ($subCategory) {
            $res['status'] = 200;
            $res['message'] = 'Sub Category Created Successfully.';
            $res['subCategory'] = (new SubCategoryResource($subCategory));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SubCategory $subCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SubCategory $subCategory)
    {
        if (!empty($subCategory)) {
            $res['status'] = 200;
            $res['message'] = 'Category Found Successfully.';
            $res['subCategory'] = (new SubCategoryResource($subCategory));
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SubCategory $subCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $data['name'] = $request->name;
        $data['icon'] = $request->icon ?? $subCategory->icon;
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;
        $data['category_id'] = $request->category_id ?? $subCategory->category_id;
        $data['priority'] = $request->priority ?? $subCategory->priority;

        if ($subCategory->update($data)) {
            $res['status'] = 200;
            $res['message'] = 'Sub Category Updated Successfully.';
            $res['subCategory'] = (new SubCategoryResource($subCategory));
        } else {
            $res['status'] = 201;
            $res['message'] = 'Request Failed';
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SubCategory $subCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SubCategory $subCategory)
    {
        if ($subCategory->delete()) {
            $res['status'] = 200;
            $res['message'] = 'Sub Category Deleted Successfully.';
        } else {
            $res['status'] = 201;
            $res['message'] = 'No Category Found';
        }
        return response()->json($res);
    }
}
