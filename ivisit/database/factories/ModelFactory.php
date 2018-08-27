<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'userName' => $faker->name,
        'email' =>    $faker->email,
        'password' => sha1('password'),
        'department'=> $faker->words(2, true)
    ];
});

$factory->define(App\AppUsers::class, function (Faker\Generator $faker) {
    return [
        'UserName'=>$faker->email,
        'Password'=>sha1('password'),
        'SalesRepDepartment'=>strtoupper($faker->words(3, true)),
        'SalesRepName'=>$faker->name,
        'SalesRepLanguage'=>'DE,EN,ES,FR,NL,PT',
        'visitLimit'=>$faker->randomDigit,
        'UserToken'=> '0.0.0',
    ];
});
