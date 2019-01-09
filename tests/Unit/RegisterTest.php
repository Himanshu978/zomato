<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    private $faker = null;

    public function setUp()
    {
        parent::setUp();

        $this->faker = \Faker\Factory::create();
    }


    /** @test */
    public function it_registers_an_user()
    {
        $district = factory(\App\District::class)->create();

        $data = [
            'username'       => $this->faker->userName,
            'email'          => $this->faker->safeEmail,
            'age'            => '22',
            'firstname'      => 'Jack',
            'lastname'       => 'Sparrow',
            'phone'          => '98323322323',
            'password'       => '123456789',
            'type'           => false,
            'street_address' => $this->faker->word,
            'district_id'    => $district->id,
            'c_password'     => '123456789',
            'zip'            => '232322'
        ];

        $response = $this->post('http://zomato.test/api/register', $data);

        $response->assertStatus(200);

        $responseData = $response->getData();

        $this->assertNotEmpty($responseData);
        $this->assertEquals($data['username'], $responseData->success->name);

    }


    /** @test */
    public function it_checks_the_user_login()
    {
        $user = factory(\App\User::class)->create([
            'email'    => 'himanshu@gmail.com',
            'password' => Hash::make('1234567'),
            'phone'    => '23232322323',
            'type'     => 1
        ]);

        $data = [
            'email'    => 'himanshu@gmail.com',
            'password' => '1234567'
        ];

        $response = $this->post('http://zomato.test/api/login', $data);

        $response->assertStatus(200);

    }


}
