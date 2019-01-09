<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatesAndDistrictsTest extends TestSetUp
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_list_of_all_the_states()
    {
        $data = [
            'name' => $this->faker->name
        ];

        factory(\App\State::class)->create($data);

        $response = $this->acting_as_user->get($this->url.'states');

        $response->assertStatus(200);

        $responseData = $response->getData()[0];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);

    }


    /** @test */
    public function it_gets_list_of_all_the_districts()
    {

        $state = factory(\App\State::class)->create();

        $data = [
            'name'     => $this->faker->name,
            'state_id' => $state->id
        ];

        factory(\App\District::class)->create($data);

        $response =  $this->acting_as_user->get($this->url.'districts/' . $state->id);

        $response->assertStatus(200);

        $responseData = $response->getData()[0];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);

    }

}
