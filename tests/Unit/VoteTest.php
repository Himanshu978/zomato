<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_toggles_the_like_on_the_review()
    {
        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $review = factory(\App\Review::class)->create();

        $data = [
            'type' => 'review',
            'id'   => $review->id
        ];

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/vote', $data);

        $response->assertStatus(201);

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/vote', $data);

        $response->assertStatus(200);

    }


    /** @test */
    public function it_toggles_the_like_on_the_image_of_restaurant()
    {
        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $restaurant = factory(\App\Restaurant::class)->create();

        $image = factory(\App\Image::class)->create([
            'imageable_id'   => $restaurant->id,
            'imageable_type' => 'restaurant'
        ]);

        $data = [
            'type' => 'restaurant',
            'id'   => $image->id
        ];

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/vote', $data);

        $response->assertStatus(201);

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/vote', $data);

        $response->assertStatus(200);

    }


}
