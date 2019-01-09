<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Restaurant;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewsTest extends TestSetUp
{

    use DatabaseTransactions;


    /** @test */
    public function it_gets_all_reviews_of_a_single_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();

        $data = [
            'content'       => $this->faker->text,
            'restaurant_id' => $restaurant->id,
        ];

        $review = factory(\App\Review::class)->create($data);



        $response =  $this->acting_as_user->get( $this->url.'reviews/' . $restaurant->id);

        $response->assertStatus(200);

        $responseData = $response->getData()[0];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['content'], $responseData->content, 'Review Content did not match!');

    }


    /** @test */
    public function it_updates_the_review()
    {
        $data = [
            'content' => $this->faker->text,
        ];

        $review = factory(\App\Review::class)->create($data);

        $update =  $this->acting_as_user->get($this->url.'reviews/' . $review->id);

        $this->assertEquals($data['content'], $review->content);

    }

    /** @test */
    public function it_creates_a_review_on_the_restaurant()
    {
        $restaurant = factory(\App\Restaurant::class)->create();

        $data = [
            'content'       => $this->faker->sentence,
            'restaurant_id' => $restaurant->id
        ];

        $response =  $this->acting_as_user->post($this->url.'reviews', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['content'], $responseData->content);

    }

    /** @test */
    public function it_deletes_a_review()
    {
        $review = factory(\App\Review::class)->create([
            'user_id' =>  $this->user->id
        ]);

        $response =  $this->acting_as_user->delete($this->url.'reviews/'.$review->id);

        $response->assertStatus(200);

    }

}
