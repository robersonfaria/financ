<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'external_code' => $faker->randomNumber(),
        'description' => $faker->text(),
        'operation' => \App\Enums\Operations::getRandomKey(),
        'value' => $faker->randomFloat(2,0),
        'consolidated' => $faker->boolean()
    ];
});

$factory->state(Transaction::class, 'credit', function(Faker $faker){
    return [
        'operation' => \App\Enums\Operations::Credit
    ];
});

$factory->state(Transaction::class, 'debit', function(Faker $faker){
    return [
        'operation' => \App\Enums\Operations::Debit
    ];
});

$factory->state(Transaction::class, 'balance', function(Faker $faker){
    return [
        'operation' => \App\Enums\Operations::Balance
    ];
});