<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customers(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        $users = User::query();
        $users->where('role', '=', 'customer');
        // to filter
        if ($request['query']) {
            $users->where('name', 'like', '%' . $request['query'] . '%');
            $total = $users->where('name', 'like', '%' . $request['query'] . '%')->get();
        } else {
            $total = $users->get();
        }
        $users = $users->paginate($request->limit ? $request->limit : 20);


        $res['total'] = $total->count();
        $res['customers'] = CustomerResource::collection($users);
        return response()->json($res);
    }
}
