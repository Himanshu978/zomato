<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteTest extends TestSetUp
{
    use DatabaseTransactions;

    /** @test */
    public function it_toggles_the_like_on_the_review()
    {
        $review = factory(\App\Review::class)->create();

        $data = [
            'type' => 'review',
            'id'   => $review->id
        ];

        $response = $this->acting_as_user->post($this->url.'vote', $data);

        $response->assertStatus(201);

        $response = $this->acting_as_user->post($this->url.'vote', $data);

        $response->assertStatus(200);

    }


    /** @test */
    public function it_toggles_the_like_on_the_image_of_restaurant()
    {
        $restaurant = factory(\App\Restaurant::class)->create();

        $image = $restaurant->image()->create([
            'url' => $this->faker->image('public',400,300)
        ]);

        $data = [
            'type' => 'restaurant',
            'id'   => $image->id
        ];

        $response = $this->acting_as_user->post($this->url.'vote', $data);

        $response->assertStatus(201);

        $response = $this->acting_as_user->post($this->url.'vote', $data);

        $response->assertStatus(200);

    }


}
