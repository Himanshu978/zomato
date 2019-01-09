<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Restaurant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestSetUp
{
    use DatabaseTransactions;


    /** @test */
    public function it_creates_a_new_comment_on_review()
    {
        $review = factory(\App\Review::class)->create();

        $data = [
            'content' => $this->faker->name,
            'id'      => $review->id,
            'type'    => 'review'
        ];

        $response = $this->acting_as_user->post($this->url . 'comments', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['content'], $responseData->content);
        $this->assertEquals($data['id'], $responseData->commenteable_id);

    }


    /** @test */
    public function it_creates_a_new_comment_on_image_of_the_restaurant()
    {
        $restaurant = factory(\App\Restaurant::class)->create();

        $image = $restaurant->image()->create([
            'url' => $this->faker->image('public',400,300)
        ]);

        $data = [
            'content' => $this->faker->name,
            'id'      => $image->id,
            'type'    => 'restaurant'
        ];

        $response = $this->acting_as_user->post($this->url . 'comments', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['content'], $responseData->content);

    }


    /** @test */
    public function it_deletes_a_comment_on_the_review()
    {
        $comment = factory(\App\Comment::class)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->acting_as_user->delete($this->url . 'comments/' . $comment->id);

        $response->assertStatus(200);

    }

}

