<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'client_id' => function(){
            return factory(\App\Models\Client::class)->create()->id;
        },
        'name' => $faker->name,
        'type' => \App\Enums\AccountType::getRandomValue(),
        'due_date' => $faker->date()
    ];
});