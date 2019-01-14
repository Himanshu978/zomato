<?php

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'street_address' => $faker->word,
        'district_id' => function () {
             return factory(App\District::class)->create()->id;
        },
        'zip' => $faker->postcode,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text,
        'user_id' => function () {
             return factory(App\User::class)->create()->id;
        },
        'commenteable_type' => rand(0, 1) == 1 ? 'image' : 'review',
        'commenteable_id' => $faker->randomNumber(),
    ];
});

$factory->define(App\Cuisine::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\District::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'state_id' => function () {
             return factory(App\State::class)->create()->id;
        },
    ];
});

$factory->define(App\Food::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'restaurant_id' => function () {
             return factory(App\Restaurant::class)->create()->id;
        },
        'cuisine_id' => function () {
             return factory(App\Cuisine::class)->create()->id;
        },
        'price' => $faker->randomNumber(),
        'description' => $faker->text,
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->url,
        'imageable_type' => rand(0, 1) == 1 ? 'restaurant' : 'review',
        'imageable_id' => $faker->randomNumber(),
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
             return factory(App\User::class)->create()->id;
        },
        'status' => 'pending',
        'restaurant_id' => function () {
             return factory(App\Restaurant::class)->create()->id;
        },
    ];
});

$factory->define(App\Restaurant::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'phone' => '932432423423',
        'opening' => $faker->time(),
        'closing' => $faker->time(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text,
        'user_id' => function () {
             return factory(App\User::class)->create()->id;
        },
        'restaurant_id' => function () {
             return factory(App\Restaurant::class)->create()->id;
        },
    ];
});

$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'age' => $faker->randomNumber(),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => '973455345342',
        'email_verified_at' => $faker->dateTimeBetween(),
        'password' => bcrypt($faker->password),
        'type' => $faker->randomNumber(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
             return factory(App\User::class)->create()->id;
        },
        'voteable_type' => rand(0, 1) == 1 ? 'image' : 'review',
        'voteable_id' => $faker->randomNumber(),
    ];
});

