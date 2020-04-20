<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_des')->nullable();
            $table->string('full_des')->nullable();
            $table->string('total_favourites')->default(0);
            $table->bigInteger('sub_category_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->float('market_price')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('last_price')->nullable();
            $table->integer('total_offer_spots')->nullable();
            $table->float('minus_price_user_price')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('sub_category_id')
                ->references('id')->on('sub_categories')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
