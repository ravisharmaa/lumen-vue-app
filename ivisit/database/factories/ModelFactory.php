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
        'email' => $faker->email,
        'password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', //sha1('password')
        'department' => $faker->words(2, true),
    ];
});

$factory->define(App\AppUsers::class, function (Faker\Generator $faker) {
    return [
        'UserName' => $faker->email,
        'Password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', //sha1('password')
        'SalesRepDepartment' => strtoupper($faker->words(3, true)),
        'SalesRepName' => $faker->name,
        'SalesRepLanguage' => 'DE,EN,ES,FR,NL,PT',
        'visitLimit' => $faker->randomDigit,
        'UserToken' => '0.0.0',
    ];
});

$factory->state(App\AppUsers::class, 'active', [
    'ActiveFlag' => true,
]);

$factory->state(App\AppUsers::class, 'inactive', [
    'ActiveFlag' => false,
]);

$factory->state(App\AppUsers::class, 'password_confirmation', [
    'Password' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
    'Password_confirmation' => '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8',
]);

$factory->define(App\Heading::class, function (Faker\Generator $faker) {
   return [
     'heading'=>$faker->sentence
   ];
});


$factory->define(App\Survey::class, function (Faker\Generator $faker) {
    return [
        'Question' => $faker->sentence,
        'CreatedBy' => $faker->email,
        'CreatedDate' => \Carbon\Carbon::parse('+2 week'),
        'ChangedBy' => $faker->email,
        'ChangedDate' => \Carbon\Carbon::parse('+1 week'),
        'headingid' => function () {
            return factory(App\Heading::class)->create()->id;
        },
   ];
});
