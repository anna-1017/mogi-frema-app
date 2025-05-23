<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ログアウトする()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');

        $this->assertGuest();

    }
}
