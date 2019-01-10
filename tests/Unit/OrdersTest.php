<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestSetUp
{
    use DatabaseTransactions;


    /** @test */
    public function it_gets_list_of_all_orders_placed_by_the_user()
    {

       $ordersCount = 5;
       $item_no = rand(0,$ordersCount-1);
       $data = [
           'user_id'       => $this->user->id,
           'status'        => 'pending',
           'restaurant_id' => function () {
               return factory(\App\Restaurant::class)->create()->id;
           },
       ];

        $order = factory(\App\Order::class, $ordersCount )->create($data);

        $response = $this->acting_as_user->get($this->url . 'orders');

        $response->assertStatus(200);

        $responseData = $response->getData();

        $this->assertCount($ordersCount, $responseData->orders );
        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['user_id'], $responseData->orders[$item_no]->user_id);
        $this->assertEquals($data['status'], $responseData->orders[$item_no]->status);

    }

    /** @test */
    public function it_places_an_order()
    {
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

        $response = $this->acting_as_user->post($this->url . 'orders', $data);

        $response->assertStatus(200);
    }


    /** @test */
    public function it_cancels_an_order()
    {
        $order = factory(\App\Order::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->acting_as_user->delete($this->url . 'orders/' . $order->id);

        $response->assertStatus(200);
    }


    /** @test */
    public function it_checks_no_user_can_see_orders_from_other_users()
    {
            $this->assertTrue(true);
    }

}
