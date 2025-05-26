<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;


class SellTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品出品情報が正しく保存される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create([
            'name' => 'バッグ',
        ]);

        $formData = [
            'category_id' => $category->id,
            'condition' => '目立った傷や汚れなし',
            'name' => '黒いトートバッグ',
            'description' => 'レザー素材のキレイ目トートバッグです。',
            'price' => '2000',

        ];

        $response = $this->post(route('items.store'), $formData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'condition' => '目立った傷や汚れなし',
            'name' => '黒いトートバッグ',
            'description' => 'レザー素材のキレイ目トートバッグです。',
            'price' => '2000',

        ]);
    }

}
