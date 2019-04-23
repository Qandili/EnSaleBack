<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;



$factory->define(App\Student::class, function (Faker $faker) {
    static $password;
    return [
        'student_cne' =>str_random(5),
        'first_name'  => $faker->name,
        'last_name'  => $faker->name,
        'email'  => $faker->unique()->safeEmail,
        'phone_number'  => $faker->phoneNumber,
        'birth_date'  => '1998-01-12',
        'confirmed_account'  => 0,
        'isAdmin'  => 0,
        'password'  => md5('1234'),
        'remember_token' => str_random(10),
    ];
});
