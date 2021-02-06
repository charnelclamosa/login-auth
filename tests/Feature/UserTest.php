<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /* @test */
    public function test_can_register_user() {
        $credentials = [
            'name' => 'Charnel S. Clamosa',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 2
        ];
        $this->post('api/users', $credentials)->assertStatus(201);
        $this->assertDatabasehas('users', [
            'name' => 'Charnel S. Clamosa',
            'email' => 'admin@gmail.com'
            ]);
    }
    /* @test */
    public function test_email_already_taken() {
        $first = [
            'name' =>  'Not a duplicate',
            'email' => 'duplicate@gmail.com',
            'password' => Hash::make('password'),
            'role' => 2
        ];
        $this->post('api/users', $first)->assertStatus(201);
        $this->assertDatabasehas('users', [
            'name' => 'Not a duplicate',
            'email' => 'duplicate@gmail.com'
            ]);

        $second = [
            'name' =>  'Duplicate',
            'email' => 'duplicate@gmail.com',
            'password' => Hash::make('password'),
            'role' => 2
        ];
        $this->post('api/users', $second)->assertStatus(400);
    }
    /* @test */
    public function test_registered_user_can_login() {
        $user = User::factory()->create();
        $this->post('api/login', ['email' => $user->email, 'password' => 'password'])->assertStatus(201);
    }
    /* @test */
    public function test_not_registered_user_cant_login() {
        $credentials = [
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ];
        $this->post('api/login', $credentials)->assertStatus(404);
    }
}
