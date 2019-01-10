<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodsTest extends TestSetUp
{
    use DatabaseTransactions;



    /** @test */
    public function it_gets_all_foods_of_a_single_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();
        $foodsCount = 5;

        $item_index = rand(0, $foodsCount-1);

        $data = [
            'name'          => $this->faker->name,
            'restaurant_id' => $restaurant->id,
            'cuisine_id'    => function () {
                return factory(\App\Cuisine::class)->create()->id;
            },
            'price'         => $this->faker->randomNumber(),
            'description'   => $this->faker->text,
        ];

        factory(\App\Food::class, $foodsCount)->create($data);

        $response = $this->acting_as_user->get($this->url . 'restaurants/' . $restaurant->id . '/foods');

        $response->assertStatus(200);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertCount($foodsCount, $responseData->foods);
        $this->assertEquals($data['name'], $responseData->foods[$item_index]->name);
        $this->assertEquals($data['price'], $responseData->foods[$item_index]->price);
        $this->assertEquals($data['description'], $responseData->foods[$item_index]->description);

    }


    /** @test */
    public function it_creates_the_food_for_the_restaurant()
    {

        $restaurant = factory(\App\Restaurant::class)->create();
        $cuisine    = factory(\App\Cuisine::class)->create();

        $data = [
            'name'          => $this->faker->name,
            'restaurant_id' => $restaurant->id,
            'cuisine_id'    => $cuisine->id,
            'price'         => $this->faker->randomNumber(),
            'description'   => $this->faker->text
        ];

        $response = $this->acting_as_user->post($this->url . 'foods', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['price'], $responseData->price);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['cuisine_id'], $responseData->cuisine_id);
        $this->assertEquals($data['restaurant_id'], $responseData->restaurant_id);

    }

}
