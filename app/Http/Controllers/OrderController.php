<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderShippingInfo;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Psr7\str;

class OrderController extends Controller
{
    public function createNewOrder(Request $request)
    {
        $user = $user = Auth::guard('api')->user();
        $product = Product::find($request->productId);
        $totalOrder = Order::all()->count();
        $productCategory = $product->category->name;
        $serialNum = !empty($totalOrder) ? $totalOrder + 1 : 1;
        $newCustomerId = strtoupper($productCategory[0]) . '-00200' . +$serialNum;

        $newOrder = Order::create(
            [
                'custom_order_id' => $newCustomerId,
                'product_id' => $product->id,
                'user_id' => $user->id,
                'quantity' => $request->quantity,
                'join_price' => $product->join_price,
                'current_price' => $product->current_price,
                'is_join_payment_enable' => $product->join_price > 0 ? 1 : 0,
                'total_price' => $request->totalPrice,
            ]
        );

        OrderShippingInfo::create([
            'order_id' => $newOrder->id,
        ]);

        echo PaymentController::createPaymentId($newOrder);

    }

    public function customerOrders()
    {
        $user = Auth::guard('api')->user();

        $res['status'] = 200;
        $res['message'] = 'User Order Fetched Successfully.';
        $res['orders'] = OrderResource::collection($user->orders);

        return response()->json($res);
    }
}
