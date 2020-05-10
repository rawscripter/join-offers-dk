<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminDashboardData()
    {
        $products = Product::query();
        $orders = Order::query();
        $customers = User::query();

        // total products
        $allProduct = $products;
        $allOrders = $orders;
        $allCustomers = $customers;
        $data['totalProducts'] = $allProduct->get()->count();
        $data['totalOrders'] = $allOrders->get()->count();
        $data['totalCustomers'] = $allCustomers->where('role', '=', 'customer')->get()->count();
        // total active offers
        $activeProduct = $products;
        $activeOrders = $orders;
        $data['activeProducts'] = $activeProduct->where('expire_date', '>', Carbon::now())->get()->count();
        $data['activeOrders'] = $activeOrders->where('order_status', 0)->where('is_canceled', 0)->get()->count();
        // total expired offers
        $expireProduct = $products;
        $completedOrders = $orders;
        $data['expiredProducts'] = $expireProduct->where('expire_date', '<', Carbon::now())->get()->count();
        $data['completedOrders'] = $completedOrders->where('order_status', 1)->get()->count();


        $res['status'] = 200;
        $res['data'] = $data;

        // json call back
        return response()->json($res);
    }
}
