<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function priceFallGraph($eventID)
    {
        $product = Product::where('event_id', $eventID)->first();
        $price = [];
        $customer = [];
        foreach ($product->orders as $key => $order) {
            array_push($price, $order->current_price);
            array_push($customer, "$key");

        }
        $res['price'] = $price;
        $res['order'] = $customer;
        return $res;
    }
}
