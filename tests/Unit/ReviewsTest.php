<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Restaurant;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewsTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function it_gets_all_reviews_of_a_single_restaurant()
    {
        $faker      = \Faker\Factory::create();
        $restaurant = factory(Restaurant::class)->create();

        $reviewsCount = 5;

        $data = [
            'content'       => $faker->text,
            'restaurant_id' => $restaurant->id,
        ];

        $review = factory(\App\Review::class)->create($data);

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/reviews/' . $restaurant->id);

        $response->assertStatus(200);

//                 ->assertJsonStructure([
//                     '*' => [
//                         'id',
//                         'content',
//                         'user_id',
//                         'restaurant_id',
//                         'created_at',
//                         'updated_at',
//                         'comments',
//                         'user'  => [
//                             'id',
//                             'username',
//                             'email',
//                             'age',
//                             'firstname',
//                             'lastname',
//                             'phone',
//                             'type'
//                         ],
//                         'votes' => []
//                     ]
//                 ]);
        $responseData = $response->getData()[0];

        $this->assertEquals($data['content'], $responseData->content, 'Review Content did not match!');

    }


    /** @test */
    public function it_updates_the_review()
    {
        $faker = \Faker\Factory::create();

        $user = factory(\App\User::class)->create();

        $data = [
            'content' => $faker->text,
        ];

        $review = factory(\App\Review::class)->create($data);

        $update = $this->actingAs($user, 'api')->get('http://zomato.test/api/reviews/' . $review->id);

        $this->assertEquals($data['content'], $review->content);

    }

    /** @test */
    public function it_creates_a_restaurant()
    {
        $user = factory(\App\User::class)->create([
            'type' => 1
        ]);

        $faker = \Faker\Factory::create();

        $restaurant = factory(\App\Restaurant::class)->create();

        $data = [
            'content'           => $faker->sentence,
            'restaurant_id' => $restaurant->id
        ];

        $response = $this->actingAs($user, 'api')->post('http://zomato.test/api/reviews', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();


//        $this->assertEquals($data['name'], $responseData->name);
//        $this->assertEquals($data['description'], $responseData->description);
//        $this->assertEquals($data['phone'], $responseData->phone);
//        $this->assertEquals($data['opening'], $responseData->opening);
//        $this->assertEquals($data['closing'], $responseData->closing);

    }

}
