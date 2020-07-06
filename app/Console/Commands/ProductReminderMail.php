<?php

namespace App\Console\Commands;

use App\Http\Controllers\MailController;
use App\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProductReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:ProductReminderMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail for product reminder';

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
        $products = Product::whereBetween('offer_start_date',
            [Carbon::now(),
                Carbon::now()->addHour()])->get();

        foreach ($products as $product) {
            $reminders = $product->reminders->where('mail_status', 0);
            $productRequests = $product->requests->where('type', 'favourite')->where('mail_status', 0);

            foreach ($reminders as $reminder) {
                MailController::sendProductReminderMail($reminder);
                $reminder->mail_status = 1;
                $reminder->save();
            }
            foreach ($productRequests as $reminder) {
                MailController::sendProductRequestReminderMail($reminder);
                $reminder->mail_status = 1;
                $reminder->save();
            }
        }
    }
}
