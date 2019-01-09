<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    public function it_gets_list_of_all_orders_placed_by_the_user()
    {
        $user = factory(\App\User::class)->create();

        $data = [
            'user_id'       => $user->id,
            'status'        => 'pending',
            'restaurant_id' => function () {
                return factory(\App\Restaurant::class)->create()->id;
            },
        ];

        $order = factory(\App\Order::class)->create($data);

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/orders');

        $response->assertStatus(200);

        $responseData = $response->getData();
//                 ->assertJsonStructure([
//                     'username',
//                     'email',
//                     'age',
//                     'firstname',
//                     'lastname',
//                     'phone',
//                     'type',
//                     'updated_at',
//                     'created_at',
//                     'id',
//                     'orders' => [
//                         '*' => [
//                             'id',
//                             'user_id',
//                             'status',
//                             'restaurant_id',
//                             'created_at',
//                             'updated_at',
//                             'foods'      => [
//                                 '*' => [
//                                     'id',
//                                     'name',
//                                     'restaurant_id',
//                                     'cuisine_id',
//                                     'price',
//                                     'description',
//                                     'created_at',
//                                     'updated_at'
//                                 ]
//                             ],
//                             'restaurant' => [
//                                 'id',
//                                 'name',
//                                 'description',
//                                 'phone',
//                                 'opening',
//                                 'closing',
//                                 'created_at',
//                                 'updated_at',
//                                 'user_id'
//                             ]
//                         ]
//                     ]
//                 ]);
        $this->assertEquals($data['user_id'], $responseData->orders[0]->user_id);
        $this->assertEquals($data['status'], $responseData->orders[0]->status);

    }

    /** @test */
    public function it_places_an_order()
    {
        $user = factory(\App\User::class)->create();

        $restaurant = factory(\App\Restaurant::class)->create();

        $food = factory(\App\Food::class)->create([
            'restaurant_id' => $restaurant->id
        ]);

        $data = [
            'restaurant_id' => $restaurant->id,
            'orderedFoods'  => [
                '0' => [
                    'food_id' => $food->id,
                    'qty'     => 2,
                ],
            ]
        ];

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/orders', $data);

        $response->assertStatus(200);
    }


    /** @test */
    public function it_cancels_an_order()
    {
        $user = factory(\App\User::class)->create();

        $order = factory(\App\Order::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'api')->delete('http://zomato.test/api/orders/'.$order->id);

        $response->assertStatus(200);

    }


}
