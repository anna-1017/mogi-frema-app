<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;


class UpdateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_プロフィール編集画面に過去の設定値が初期表示される()
    {
        $user = User::factory()->create([
            'name' => '髙地こち',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'postcode' => '111-2222',
            'address' => '千葉県柏市',
            'building' => '柏ビル',
            'image_path' => 'profile_images/sample.jpg',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('profile.edit'));

        $response->assertStatus(200);

        $response->assertSee('髙地こち');
        $response->assertSee('111-2222');
        $response->assertSee('千葉県柏市');
        $response->assertSee('柏ビル');
        $response->assertSee('profile_images/sample.jpg');
    }
}
