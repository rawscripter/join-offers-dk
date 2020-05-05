<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderPaymentResource;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderPayment;
use App\OrderShippingInfo;
use App\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public static function createPaymentId(Order $order)
    {

        $datastring = '{"order": {
        "items": [{
            "reference": "' . $order->custom_order_id . '",
            "name": "' . $order->product->name . '",
            "quantity": ' . $order->quantity . ',
            "unit": "pcs",
            "unitPrice": 0,
            "taxRate": 0,
            "taxAmount": 0,
            "grossTotalAmount": ' . $order->total_price * 100 . ',
            "netTotalAmount": ' . $order->total_price . '
        }
        ],
        "amount": ' . $order->total_price * 100 . ',
        "currency": "dkk",
        "reference": "' . $order->id . '"
        },
        "checkout": {
            "url": "http://laravu.test/checkout/payment/status",
            "termsUrl": "http://laravu.test/om",
            "merchantHandlesConsumerData":true,
               "shippingCountries":
               [
                   {"countryCode": "DNK"}
               ],
               "consumerType": {
                "supportedTypes": ["B2C", "B2B"],
                   "default": "B2C"
               }
           },
    }';
        $ch = curl_init('https://test.api.dibspayment.eu/v1/payments');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datastring);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: test-secret-key-545225c85d254ef296283fcba54bd26c')
        );
        return $result = curl_exec($ch);
    }


    public
    function paymentDetails($payId)
    {
        $orderPayment = OrderPayment::where('paymentId', $payId)->first();
        if (empty($orderPayment)) {
            $ch = curl_init('https://test.api.dibspayment.eu/v1/payments/' . $payId . '');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array('Content-Type: application/json', 'Accept: application/json',
                    'Authorization: test-secret-key-545225c85d254ef296283fcba54bd26c')
            );
            $result = curl_exec($ch);
            $paymentDetails = json_decode($result, true);
            $paymentData = $paymentDetails['payment'];
            $OrderData = $paymentDetails['payment']['orderDetails'];
            $orderId = (int)$OrderData['reference'];
            $receivedAmount = $paymentData['summary']['reservedAmount'] ?? '';
        } else {
            $orderId = $orderPayment->order_id;
            $receivedAmount = $orderPayment->amount;
        }

//        return $paymentData;
        if (empty($receivedAmount)) {
            $res['status'] = 201;
            $res['message'] = 'Payment Failed';
            $res['payment']['isPaid'] = false;
            OrderShippingInfo::where('order_id',$orderId)->delete();
            Order::find($orderId)->delete();
        } else {
            $order = Order::find($orderId);
            //   $orderPayment = OrderPayment::where('paymentId', $payId)->where('order_id', $order->id)->first();
            if (empty($orderPayment)) {
                // update product table
                //minus product current price
                $product = Product::find($order->product->id);
                if ($product->current_price > $product->last_price) {
                    if ($product->minus_price_user_price > 0) {
                        $product->current_price = $product->current_price - $product->minus_price_user_price;
                        $product->save();
                    }
                }
                // update order table
                $order->is_join_offer_paid = true;
                $order->save();

                $orderPayment = OrderPayment::create([
                    'order_id' => $order->id,
                    'paymentId' => $payId,
                    //1 for join payment
                    //2 for full payment
                    'type' => '1',
                    'status' => 'paid',
                    'amount' => $receivedAmount / 100,
                ]);
            }
            $res['status'] = 200;
            $res['message'] = 'Payment Successful';
            $res['payment']['isPaid'] = true;
            $res['order'] = new OrderResource($order);
            $res['orderPayment'] = new OrderPaymentResource($orderPayment);
        }
        return response()->json($res);
    }
}
