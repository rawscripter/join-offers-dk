<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderShippingInfo;
use App\Product;
use App\Subscriber;
use App\TemporaryOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        $res['status'] = 200;
        $res['message'] = 'All Categories';
        $orders = Order::query();

        // only product orders
        if (isset($request->product)) {
            $orders->where('product_id', $request->product);
        }

        // all running orders
        if ($request->status == 'running') {
            $orders->where('order_status', 0);
        }
        // all complete orders
        if ($request->status == 'complete') {
            $orders->where('order_status', 1);
        }
        // all complete orders
        if ($request->status == 'canceled') {
            $orders->where('is_canceled', 1);
        } else {
            $orders->where('is_canceled', 0);
        }

        // to filter
        if ($request['query']) {
            $orders->where('custom_order_id', 'like', '%' . $request['query'] . '%')
                ->orWhere('id', 'like', '%' . $request['query'] . '%');
        }

        if ($request->orderBy) {
            $orders->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orders = $orders->paginate($request->limit ? $request->limit : 20);

        $res['total'] = $orders->total();
        $res['orders'] = OrderResource::collection($orders);
        return response()->json($res);
    }

    public function createTemporaryOrder(Request $request)
    {
        $user = $user = Auth::guard('api')->user();
        $product = Product::find($request->productId);
        $totalOrder = Order::all()->count();
        $productCategory = $product->category->name;
        $serialNum = !empty($totalOrder) ? $totalOrder + 1 : 1;
        $newCustomerId = strtoupper($productCategory[0]) . '-00200' . +$serialNum;

        if ($request->newsletter) {

            if (!$user->isSubscribed()){
                Subscriber::create([
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);
            }
        }

        $newOrder = TemporaryOrder::create(
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

        echo PaymentController::createPaymentId($newOrder);

    }

    public static function createNewOrder(TemporaryOrder $order)
    {
        $newOrder = Order::create(
            [
                'custom_order_id' => $order->custom_order_id,
                'product_id' => $order->product_id,
                'user_id' => $order->user_id,
                'quantity' => $order->quantity,
                'join_price' => $order->join_price,
                'current_price' => $order->current_price,
                'is_join_payment_enable' => $order->is_join_payment_enable,
                'total_price' => $order->total_price,
                'payment_deadline' => Carbon::parse($order->product->expire_date)->addDays(7),
            ]
        );

        OrderShippingInfo::create([
            'order_id' => $newOrder->id,
        ]);

        return $newOrder;
    }

    public function customerOrders(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($request->status == 'running') {
            $orders = $user->runningOrders;
        }

        if ($request->status == 'completed') {
            $orders = $user->completedOrders;
        }

        if ($request->status == 'canceled') {
            $orders = $user->canceledOrders;
        }
        $res['status'] = 200;
        $res['message'] = 'User Order Fetched Successfully.';
        $res['orders'] = OrderResource::collection($orders);

        return response()->json($res);
    }

    public function orderDetails($orderId)
    {
        $order = Order::where('custom_order_id', $orderId)->first();
        if ($order) {
            $res['status'] = 200;
            $res['message'] = 'Payment Successful';
            $res['payment']['isPaid'] = true;
            $res['order'] = new OrderResource($order);
        } else {
            $res['status'] = 201;
            $res['payment']['isPaid'] = false;
            $res['message'] = 'No Record Found.';
        }
        return response()->json($res);
    }
}
