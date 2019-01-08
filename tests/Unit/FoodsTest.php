<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodsTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    public function it_gets_all_foods_of_a_single_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();

        $faker = \Faker\Factory::create();

        $data = [
            'name' => $faker->name,
            'restaurant_id' => $restaurant->id,
            'cuisine_id' => function () {
                return factory(\App\Cuisine::class)->create()->id;
            },
            'price' => $faker->randomNumber(),
            'description' => $faker->text,
        ];

//       $foodsCount = 5;

        factory(\App\Food::class)->create($data);

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/restaurants/' . $restaurant->id . '/foods');

        $response->assertStatus(200);
//                 ->assertJsonStructure([
//                         'id',
//                         'name',
//                         'user_id',
//                         'description',
//                         'phone',
//                         'opening',
//                         'closing',
//                         'updated_at',
//                         'user_id',
//                         'foods' => [
//                             '*' => [
//                                 'id',
//                                 'name',
//                                 'restaurant_id',
//                                 'cuisine_id',
//                                 'price',
//                                 'description',
//                                 'created_at',
//                                 'updated_at'
//                             ]
//                         ]
//                 ]);
        $responseData = $response->getData();

        $this->assertEquals($data['name'], $responseData->foods[0]->name);
        $this->assertEquals($data['price'], $responseData->foods[0]->price);
        $this->assertEquals($data['description'], $responseData->foods[0]->description);

    }
}
