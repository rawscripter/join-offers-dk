<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $cat = \App\Category::all()->random();
    $user = \App\User::all()->random();

    $marketPrice = rand(500, 10000);
    $offer_price = $marketPrice - rand(50, 200);
    $lastPrice = $marketPrice - 400;
    $total_offer_spots = rand(100, 150);
    $minus_per_user = rand(50, 100);
    $items = ['All', 'Men', 'Women', 'Kids'];
    $productType = $items[array_rand($items)];;
    $eventId = (new \App\Http\Controllers\ProductController)->generateEventId(8);
    $randomDay = rand(5, 10);
    $expireDate = \Carbon\Carbon::now()->addDays($randomDay);
    return [
        'name' => $faker->name,
        'slug' => \Illuminate\Support\Str::slug($faker->name),
        'image' => '69b8ac40-864b-11ea-ad3e-75d58cbedf83.png',
        'event_id' => $eventId,
        'short_des' => $faker->realText(100),
        'full_des' => $faker->realText(1000),
        'category_id' => $cat->id,
        'sub_category_id' => $cat->subCategories->random()->id,
        'total_favourites' => 0,
        'market_price' => $marketPrice,
        'offer_price' => $offer_price,
        'join_price' => 50,
        'max_unit_per_user' => 5,
        'last_price' => $lastPrice,
        'current_price' => $lastPrice,
        'total_offer_spots' => $total_offer_spots,
        'minus_price_user_price' => $minus_per_user,
        'expire_date' => $expireDate,
        'product_type' => $productType,
        'user_id' => $user->id,
    ];
});
