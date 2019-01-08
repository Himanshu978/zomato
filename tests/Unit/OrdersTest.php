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

       // $ordersCount = 5;

        $data =[
            'user_id' => $user->id,
            'status' => 'pending',
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
}
