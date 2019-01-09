<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestSetUp extends TestCase
{
    protected  $user = null;
    protected $acting_as_user = null;
    protected $url = "";

    protected $faker = null;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->user           = factory(\App\User::class)->create([
            'type' => 2
        ]);
        $this->acting_as_user = $this->actingAs($this->user, 'api');
        $this->url            = "http://zomato.test/api/";

        $this->faker = \Faker\Factory::create();
    }


}