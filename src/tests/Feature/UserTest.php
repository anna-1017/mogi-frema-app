<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Purchase;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_プロフィールページで必要な情報が表示される()
    {
        $user = User::factory()->create(['name' => 'テストユーザー']);

        $profile = Profile::create([
            'user_id' => $user->id,
            'img_url' => 'test_image.jpg',
            'postcode' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストビル',
        ]);

        $product1 = Product::factory()->create(['user_id' => $user->id, 'name' => '出品商品1']);

        $otherProduct = Product::factory()->create();
        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $otherProduct->id,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('profile.show', ['user' => $user->id]));

        $response->assertStatus(200);

        $response->assertSee('test_image.jpg');

        $response->assertSee('テストユーザー');

        $response->assertSee('出品商品1');

        $response->assertSee($otherProduct->name);
    }
}
