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
        $states_count = 10;
        $item_index = rand(0, $states_count-1);
        $data = [
            'name' => $this->faker->name
        ];

        factory(\App\State::class, $states_count)->create($data);

        $response = $this->acting_as_user->get($this->url . 'states');

        $response->assertStatus(200);

        $this->assertCount($states_count, $response->getData());

        $responseData = $response->getData()[$item_index];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);

    }


    /** @test */
    public function it_gets_list_of_all_the_districts()
    {
        $district_count = 5;
        $item_index = rand(0, $district_count-1);

        $state = factory(\App\State::class)->create();

        $data = [
            'name'     => $this->faker->name,
            'state_id' => $state->id
        ];

        factory(\App\District::class, $district_count)->create($data);

        $response = $this->acting_as_user->get($this->url . 'districts/' . $state->id);

        $response->assertStatus(200);

        $this->assertCount($district_count, $response->getData());

        $responseData = $response->getData()[$item_index];

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['name'], $responseData->name);

    }

}
