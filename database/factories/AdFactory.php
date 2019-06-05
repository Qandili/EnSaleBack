<?php

use App\Models\Ad;
use Faker\Generator as Faker;


$factory->define(Ad::class, function (Faker $faker) {
    $usersIDs = DB::table('users')->pluck('id');
    $categoriesIDs= DB::table('categories')->pluck('id');
    return [
        'description'  => $faker->text,
        'title'  => $faker->text(50),
        'price'  => 100,
        'sold'  => 0,
        'user_id'  =>  $faker->randomElement($usersIDs),
        'categorie_id'  => $faker->randomElement($categoriesIDs),
    ];
});
