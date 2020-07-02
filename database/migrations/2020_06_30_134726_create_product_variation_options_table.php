<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->float('price')->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')->on('products');
            $table->bigInteger('product_variation_id')->unsigned();
            $table->foreign('product_variation_id')
                ->references('id')->on('product_variations');
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
        Schema::dropIfExists('product_variation_options');
    }
}
