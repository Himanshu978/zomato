<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_new_comment_on_review()
    {
        $review = factory(\App\Review::class)->create();

        $faker = \Faker\Factory::create();

        $data = [
            'content' => $faker->name,
            'id'      => $review->id,
            'type'    => 'review'
        ];

        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/comments', $data);


        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertEquals($data['content'], $responseData->content);

    }


    /** @test */
    public function it_creates_a_new_comment_on_image_of_the_restaurant()
    {
        $restaurant = factory(\App\Restaurant::class)->create();

        $image = factory(\App\Image::class)->create([
            'imageable_id'   => $restaurant->id,
            'imageable_type' => 'restaurant'
        ]);

        $faker = \Faker\Factory::create();

        $data = [
            'content' => $faker->name,
            'id'      => $image->id,
            'type'    => 'restaurant'
        ];

        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/comments', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertEquals($data['content'], $responseData->content);

    }


    /** @test */
    public function it_deletes_a_comment_on_the_review()
    {
        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $comment = factory(\App\Comment::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'api')->delete('http://zomato.test/api/comments/'.$comment->id);

        $response->assertStatus(200);

    }

}

