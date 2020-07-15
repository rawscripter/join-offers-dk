<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderPaymentResource;
use App\Http\Resources\OrderResource;
use App\Order;
use App\OrderPayment;
use App\OrderShippingInfo;
use App\Product;
use App\TemporaryOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public static function createPaymentId(TemporaryOrder $order)
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
            "netTotalAmount": ' . $order->total_price * 100 . '
        }
        ],
        "amount": ' . $order->total_price * 100 . ',
        "currency": "dkk",
        "reference": "' . $order->custom_order_id . '"
        },
        "checkout": {
            "url": "' . env('APP_URL') . '/checkout/payment/status",
            "termsUrl": "http://offer.danpanel.dk/om",
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
                'Authorization: ' . env("DIBS_KEY") . '')
        );
        return $result = curl_exec($ch);
    }

    public static function createFullPaymentId(Order $order)
    {
        $total = $order->finalPaymentAmount();
        $datastring = '{"order": {
        "items": [{
            "reference": "' . $order->custom_order_id . '",
            "name": "' . $order->product->name . '",
            "quantity": ' . $order->quantity . ',
            "unit": "pcs",
            "unitPrice": 0,
            "taxRate": 0,
            "taxAmount": 0,
            "grossTotalAmount": ' . $total * 100 . ',
            "netTotalAmount": ' . $total * 100 . '
        }
        ],
        "amount": ' . $total * 100 . ',
        "currency": "dkk",
        "reference": "' . $order->custom_order_id . '"
        },
        "checkout": {
            "url": "' . env('APP_URL') . '/checkout/payment/status",
            "termsUrl": "http://offer.danpanel.dk/om",
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
                'Authorization: ' . env("DIBS_KEY") . '')
        );
        return $result = curl_exec($ch);
    }

    public function storePaymentDetails(Request $request)
    {
        $paymentFailed = $request->paymentFailed;
        $paymentId = $request->paymentId;
        $ch = curl_init('https://test.api.dibspayment.eu/v1/payments/' . $paymentId . '');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json', 'Accept: application/json',
                'Authorization: ' . env("DIBS_KEY") . '')
        );
        $result = curl_exec($ch);
        $paymentDetails = json_decode($result, true);
        $paymentData = $paymentDetails['payment'];
        $OrderData = $paymentDetails['payment']['orderDetails'];
        $orderId = $OrderData['reference'];
        $receivedAmount = $paymentData['summary']['reservedAmount'] ?? '';
        // if failed then return with error message
        if ($paymentFailed) {
            //delete temporary table data
            $temporaryOrder = TemporaryOrder::where('custom_order_id', $orderId)->first();
            if ($temporaryOrder) {
                $temporaryOrder->delete();
            }
            // if payment failed delete the order
            return redirect('/order/payment?status=failed');
        }
        // payment complete
        $order = Order::where('custom_order_id', $orderId)->first();
        if (empty($order)) {
            // now store payment data to order Table
            $temporaryOrder = TemporaryOrder::where('custom_order_id', $orderId)->orderBy('created_at', 'desc')->first();
            $order = OrderController::createNewOrder($temporaryOrder);
            //delete temporary table data
            $temporaryOrder->delete();
            // reduce product price
            $product = Product::find($order->product->id);
            $product->reduceProductPriceOnUserOrder($order->quantity);
            //set join offer paid as true
            $order->is_join_price_paid = 1;
            $type = 1;
        } else {
            // set order full payment paid as true
            $order->is_full_price_paid = 1;
            $order->order_status = 1;
            $type = 2;
        }
        //save order payment info
        $order->save();
        //save order payment info
        OrderPayment::create([
            'order_id' => $order->id,
            'paymentId' => $paymentId,
            //1 for join payment
            //2 for full payment
            'type' => $type,
            'status' => 'paid',
            'amount' => $receivedAmount / 100,
        ]);
        return redirect('/order/payment?status=success&order=' . $order->custom_order_id . '&type=' . $type);
    }
}
