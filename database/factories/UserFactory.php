<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'cne' =>str_random(5),
        'first_name'  => $faker->firstName,
        'last_name'  => $faker->lastName,
        'email'  => $faker->unique()->safeEmail,
        'phone_number'  => $faker->phoneNumber,
        'birth_date'  => '1998-01-12',
        'confirmed_account'  => 0,
        'isAdmin'  => 0,
        'password'  => Hash::make('12345'),
        'remember_token' => str_random(10),
    ];
});
