<?php

namespace App\Observers;

use App\Http\Controllers\MailController;
use App\OrderPayment;

class OrderPaymentObserver
{
    /**
     * Handle the order payment "created" event.
     *
     * @param \App\OrderPayment $orderPayment
     * @return string
     */
    public function created(OrderPayment $orderPayment)
    {
        try {
            // send first Order Payment Confirmation mail
            if ($orderPayment->type == 1) {
                MailController::sendMailToUserAtOrderFirstPayment($orderPayment->order);
            };

            // send first Order Payment Confirmation mail
            if ($orderPayment->type == 2) {
                MailController::sendMailToUserAtOrderSecondPayment($orderPayment->order);
            };
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Handle the order payment "updated" event.
     *
     * @param \App\OrderPayment $orderPayment
     * @return void
     */
    public function updated(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Handle the order payment "deleted" event.
     *
     * @param \App\OrderPayment $orderPayment
     * @return void
     */
    public function deleted(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Handle the order payment "restored" event.
     *
     * @param \App\OrderPayment $orderPayment
     * @return void
     */
    public function restored(OrderPayment $orderPayment)
    {
        //
    }

    /**
     * Handle the order payment "force deleted" event.
     *
     * @param \App\OrderPayment $orderPayment
     * @return void
     */
    public function forceDeleted(OrderPayment $orderPayment)
    {
        //
    }
}
