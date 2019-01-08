<?php

namespace Tests\Unit;

use App\Restaurant;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }


    /** @test */
    public function it_gets_list_of_all_restaurants()
    {

        $restaurantsCount = 8;

        $faker = \Faker\Factory::create();

        $data = [
            'name'        => $faker->name,
            'description' => $faker->text,
            'phone'       => $faker->phoneNumber,
            'opening'     => $faker->time(),
            'closing'     => $faker->time(),
            'user_id'     => function () {
                return factory(\App\User::class)->create()->id;
            },
        ];

        $restaurants = factory(Restaurant::class)->create($data);

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/restaurants');

        $response->assertStatus(200);
//                 ->assertJsonStructure([
//                     '*' => [
//                         'name',
//                         'description',
//                         'opening',
//                         'closing',
//                         'phone',
//                         'user_id'
//                     ]
//                 ]);

        $responseData = $response->getData()[0];

//      $this->assertEquals($restaurantsCount, count($response->getData()));
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['phone'], $responseData->phone);
        $this->assertEquals($data['opening'], $responseData->opening);
        $this->assertEquals($data['closing'], $responseData->closing);


    }

    /** @test */
    public function it_gets_a_single_restaurant()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'name'        => $faker->name,
            'description' => $faker->text,
            'phone'       => $faker->phoneNumber,
            'opening'     => $faker->time(),
            'closing'     => $faker->time(),
            'user_id'     => function () {
                return factory(\App\User::class)->create()->id;
            },
        ];

        $restaurant = factory(Restaurant::class)->create($data);

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/restaurants/' . $restaurant->id);

        $response->assertStatus(200);
//                 ->assertJsonStructure([
//                     'name',
//                     'description',
//                     'opening',
//                     'closing',
//                     'phone',
//                     'user_id',
//                     'cuisines',
//                     'address',
//                     'image'
//                 ]);

        $responseData = $response->getData();

        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['phone'], $responseData->phone);
        $this->assertEquals($data['opening'], $responseData->opening);
        $this->assertEquals($data['closing'], $responseData->closing);

    }

    /** @test */
//    public function it_gets_the_image_of_the_restaurant()
//    {
//        $restaurant = factory(Restaurant::class)->create();
//
//        $user = factory(\App\User::class)->create();
//
//    }

    /** @test */
//    pubic function it_creates_the_restaurant()
//    {
//
//        $restaurant = factory(Restaurant::class)->create();
//
//
//    }

    /**  */
    public function it_uploads_the_image_of_the_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();

        $user = factory(\App\User::class)->create();

        $image = factory(\App\Image::class)->create([
            'imageable_id'   => $restaurant->id,
            'imageable_type' => 'App\Restaurant'
        ]);

        $image_name = explode('/', $image->url)[1];

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/restaurants/image/' . $image_name);

        $response->assertStatus(200);

    }


}
