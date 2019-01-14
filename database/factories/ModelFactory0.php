<?php

//$factory->define(App\Address::class, function (Faker\Generator $faker) {
//    return [
//        'street_address' => $faker->word,
//        'district_id' => function () {
//             return factory(App\District::class)->create()->id;
//        },
//        'zip' => $faker->postcode,
//        'addressable_id' => $faker->randomNumber(),
//        'addressable_type' => rand(0, 1) == 1 ? 'App\User' : 'App\Restaurant',
//    ];
//});
//
//$factory->define(App\Comment::class, function (Faker\Generator $faker) {
//    return [
//        'content' => $faker->text,
//        'user_id' => function () {
//             return factory(App\User::class)->create()->id;
//        },
//        'commenteable_id' => $faker->randomNumber(),
//        'commenteable_type' => rand(0, 1) == 1 ? 'App\Image' : 'App\Review',
//    ];
//});
//
//$factory->define(App\Cuisine::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//    ];
//});
//
//$factory->define(App\District::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'state_id' => function () {
//             return factory(App\State::class)->create()->id;
//        },
//    ];
//});
//
//$factory->define(App\Food::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'restaurant_id' => function () {
//             return factory(App\Restaurant::class)->create()->id;
//        },
//        'cuisine_id' => function () {
//             return factory(App\Cuisine::class)->create()->id;
//        },
//        'price' => $faker->randomNumber(),
//        'description' => $faker->text,
//    ];
//});
//
//$factory->define(App\Image::class, function (Faker\Generator $faker) {
//    return [
//        'url' => $faker->image('public',400,300),
//        'imageable_id' => $faker->randomNumber(),
//        'imageable_type' => rand(0, 1) == 1 ? 'App\Restaurant' : 'App\Review',
//    ];
//});
//
//$factory->define(App\Order::class, function (Faker\Generator $faker) {
//    return [
//        'user_id' => function () {
//             return factory(App\User::class)->create()->id;
//        },
//        'status' => 'pending',
//        'restaurant_id' => function () {
//             return factory(App\Restaurant::class)->create()->id;
//        },
//    ];
//});
//
//$factory->define(App\Restaurant::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//        'description' => $faker->text,
//        'phone' => $faker->phoneNumber,
//        'opening' => $faker->time(),
//        'closing' => $faker->time(),
//        'user_id' => function () {
//            return factory(App\User::class)->create()->id;
//        },
//    ];
//});
//
//$factory->define(App\Review::class, function (Faker\Generator $faker) {
//    return [
//        'content' => $faker->text,
//        'user_id' => function () {
//             return factory(App\User::class)->create()->id;
//        },
//        'restaurant_id' => function () {
//             return factory(App\Restaurant::class)->create()->id;
//        },
//    ];
//});
//
//$factory->define(App\State::class, function (Faker\Generator $faker) {
//    return [
//        'name' => $faker->name,
//    ];
//});
//
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    return [
//        'username' => $faker->userName,
//        'email' => $faker->safeEmail,
//        'age' => $faker->randomNumber(),
//        'firstname' => $faker->firstName,
//        'lastname' => $faker->lastName,
//        'phone' => $faker->phoneNumber,
//        'email_verified_at' => $faker->dateTimeBetween(),
//        'password' => bcrypt($faker->password),
//        'type' => $faker->randomNumber(),
//        'remember_token' => str_random(10),
//    ];
//});
//
//$factory->define(App\Vote::class, function (Faker\Generator $faker) {
//    return [
//        'user_id' => function () {
//             return factory(App\User::class)->create()->id;
//        },
//        'voteable_id' => $faker->randomNumber(),
//        'voteable_type' => rand(0, 1) == 1 ? 'App\Image' : 'App\Review',
//    ];
//});

