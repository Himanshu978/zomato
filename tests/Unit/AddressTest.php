<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_list_of_all_the_states()
    {
        $faker = \Faker\Factory::create();

        $user = factory(\App\User::class)->create();

        $data = [
            'name' => $faker->name
        ];

        factory(\App\State::class)->create($data);

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/states');

        $response->assertStatus(200);

        $responseData = $response->getData()[0];

        $this->assertEquals($data['name'], $responseData->name);

    }


    /** @test */
    public function it_gets_list_of_all_the_districts()
    {
        $faker = \Faker\Factory::create();

        $user = factory(\App\User::class)->create();

        $state =  factory(\App\State::class)->create();


        $data = [
            'name' => $faker->name,
            'state_id' => $state->id
        ];

        factory(\App\District::class)->create($data);

        $response = $this->actingAs($user, 'api')->get('http://zomato.test/api/districts/'.$state->id);

        $response->assertStatus(200);

        $responseData = $response->getData()[0];

        $this->assertEquals($data['name'], $responseData->name);

    }

}
