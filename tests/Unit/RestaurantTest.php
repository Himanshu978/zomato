<?php

namespace Tests\Unit;

use App\Restaurant;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

class RestaurantTest extends TestSetUp
{

    use DatabaseTransactions;


    /** @test */
    public function it_gets_list_of_all_restaurants()
    {
        $restaurants_count = 5;
        $item_index = rand(0, $restaurants_count-1);

        $data = [
            'name'        => $this->faker->name,
            'description' => $this->faker->text,
            'phone'       => $this->faker->phoneNumber,
            'opening'     => $this->faker->time(),
            'closing'     => $this->faker->time(),
            'user_id'     => function () {
                return factory(\App\User::class)->create()->id;
            },
        ];

        $restaurants = factory(Restaurant::class, $restaurants_count)->create($data);

        $response = $this->acting_as_user->get($this->url . 'restaurants');

        $response->assertStatus(200);

        $this->assertCount($restaurants_count, $response->getData());
        $responseData = $response->getData()[$item_index];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['phone'], $responseData->phone);
        $this->assertEquals($data['opening'], $responseData->opening);
        $this->assertEquals($data['closing'], $responseData->closing);

    }

    /** @test */
    public function it_gets_a_single_restaurant()
    {
        $data = [
            'name'        => $this->faker->name,
            'description' => $this->faker->text,
            'phone'       => $this->faker->phoneNumber,
            'opening'     => $this->faker->time(),
            'closing'     => $this->faker->time(),
            'user_id'     => function () {
                return factory(\App\User::class)->create()->id;
            },
        ];

        $restaurant = factory(Restaurant::class)->create($data);
        $restaurant->addresses()->save(factory(\App\Address::class)->create());


        $response = $this->acting_as_user->get($this->url . 'restaurants/' . $restaurant->id);

        $response->assertStatus(200);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['phone'], $responseData->phone);
        $this->assertEquals($data['opening'], $responseData->opening);
        $this->assertEquals($data['closing'], $responseData->closing);

    }

    /** @test */
    public function it_creates_a_restaurant()
    {

        $district = factory(\App\District::class)->create();

        $image_path = $this->faker->image('public', 400, 300);
        $image_name = explode('/', $image_path)[1];

        $image = File::get(public_path($image_name));

        $data = [
            'name'           => 'ooaooaoa',
            'description'    => $this->faker->text,
            'phone'          => '922342342232',
            'opening'        => $this->faker->time(),
            'closing'        => $this->faker->time(),
            'user_id'        => $this->user->id,
            'street_address' => $this->faker->word,
            'district_id'    => $district->id,
            'zip'            => '121212',
            'image'          => 'data:image/jpeg;base64,' . base64_encode($image)
        ];

        $response = $this->acting_as_user->post($this->url . 'restaurants', $data);

        $response->assertStatus(201);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);
        $this->assertEquals($data['description'], $responseData->description);
        $this->assertEquals($data['phone'], $responseData->phone);
        $this->assertEquals($data['opening'], $responseData->opening);
        $this->assertEquals($data['closing'], $responseData->closing);

    }


    /** @test */
    public function it_gets_the_image_of_the_restaurant()
    {
        $restaurant = factory(Restaurant::class)->create();

        $image = $restaurant->image()->create([
            'url' => $this->faker->image('public',400,300)
        ]);

        $image_name = explode('/', $image->url)[1];

        $response = $this->acting_as_user->get($this->url . 'restaurants/image/' . $image_name);

        $response->assertStatus(200);

    }


}
