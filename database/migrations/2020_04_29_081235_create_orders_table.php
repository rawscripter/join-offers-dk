<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('custom_order_id')->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('join_price')->unsigned();
            $table->float('current_price')->unsigned();
            $table->float('total_price')->unsigned();
            $table->boolean('is_join_payment_enable');
            $table->boolean('is_join_price_paid');
            $table->boolean('is_paid_full_price')->default(0);
            $table->boolean('order_status')->default(0);
            $table->boolean('is_canceled')->default(0);
            $table->bigInteger('canceled_by')->unsigned();
            $table->timestamp('payment_deadline')->nullable();

            $table->foreign('product_id')
                ->references('id')->on('products');
            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
