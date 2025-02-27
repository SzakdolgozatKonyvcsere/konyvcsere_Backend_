<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /*public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function test_user_all_users(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function test_show_given_user(): void
    {
        $response = $this->get('/api/user/2');

        $response->assertStatus(200);
    }
    
    public function test_re_migrate(): void
    {
        Artisan::call('migrate:fresh --seed');

        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    

}
