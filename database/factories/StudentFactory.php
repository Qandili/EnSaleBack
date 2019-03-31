<?php

use Faker\Generator as Faker;



$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'student_cne' => $faker->text(50),
        'first_name'  => $faker->text(50),
        'last_name'  => $faker->text(50),
        'password'  => $faker->text(50)
    ];
});
