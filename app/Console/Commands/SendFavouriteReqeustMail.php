<?php

namespace App\Console\Commands;

use App\Http\Controllers\MailController;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendFavouriteReqeustMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:sendFavouriteRequestMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail for Favourite Requests.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::where('is_canceled', 0)
            ->where('order_status', 0)
            ->where('is_full_price_paid', 0)
            ->whereBetween('payment_deadline',
                [Carbon::now()->setTime(0, 0)->format('Y-m-d H:i:s'),
                    Carbon::now()->setTime(23, 59, 59)->format('Y-m-d H:i:s')])->get();

        foreach ($orders as $order) {
            MailController::paymentReminderBeforeDeadline($order);
        }

    }
}
