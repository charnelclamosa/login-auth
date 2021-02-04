<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_can_register_user() {
    //     $credentials = [
    //         'name' => $this->faker->name,
    //         'email' => $this->faker->unique()->safeEmail,
    //         'password' => Hash::make('password'),
    //         'role' => 2
    //     ];
    //     $response = $this->json('POST', '/api/users', $credentials);
    //     $response->assertStatus(201);
    // }
    public function test_email_already_taken() {
        $duplicate = $this->json('POST', '/api/users', [
            'name' =>  $this->faker->name,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
            ]);
            $duplicate->assertStatus(400);
    }

    // public function test_can_get_users() {
    //     $response = $this->json('GET', 'api/users');
    //     $response->assertStatus(200);
    //     $response->assertJsonStructure([
    //         [
    //             'id',
    //             'name',
    //             'email',
    //             'role'
    //         ]
    //     ]);
    // }
}
