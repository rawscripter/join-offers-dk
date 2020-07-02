<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function adminDashboardData()
    {
        $user = Auth::guard('api')->user();
        $data['totalOrders'] = $user->orders->count();
        $data['activeOrders'] = $user->runningOrders->count();
        $data['completedOrders'] = $user->completedOrders->count();
        $data['canceledOrders'] = $user->canceledOrders->count();
        $res['status'] = 200;
        $res['data'] = $data;
        // json call back
        return response()->json($res);
    }
}
