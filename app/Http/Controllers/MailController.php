<?php

namespace App\Http\Controllers;

use App\Mail\OrderFirstPaymentMail;
use App\Mail\OrderSecondPaymentMail;
use App\Mail\PaymentReminderMailBeforeExpire;
use App\Mail\UserCreateAccountMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendMailToAdminOnNewUserRegister($user)
    {
        $sendToMail = $user->email;
        $mail = Mail::to($sendToMail)->send(new UserCreateAccountMail($user));
        return $mail ? true : false;
    }


    public static function sendMailToUserAtOrderFirstPayment($order)
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new OrderFirstPaymentMail($order));
        return $mail ? true : false;
    }

    public static function sendMailToUserAtOrderSecondPayment($order)
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new OrderSecondPaymentMail($order));
        return $mail ? true : false;
    }

    public static function paymentReminderBeforeDeadline($order)
    {
        $sendToMail = $order->user->email;
        $mail = Mail::to($sendToMail)->send(new PaymentReminderMailBeforeExpire($order));
        return $mail ? true : false;
    }
}
