<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;

class ProductlistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_全商品を取得できる()
    {
        $products = \App\Models\Product::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        foreach ($products as $product){
            $response->assertSee($product->name);
        }

    }

    public function test_購入済み商品はsoldと表示される()
    {
        $seller = \App\Models\User::factory()->create();
        $buyer = \App\Models\User::factory()->create();

        $product =\App\Models\Product::factory()->create([
            'user_id' => $seller->id,
            'buyer_id' => $buyer->id,
        ]);

        $response = $this->get('/');

        $response->assertSee('sold');
    }

    public function test_自分が出品した商品は商品一覧に表示されない()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $myProduct = \App\Models\Product::factory()->create([
            'user_id' => $user->id,
        ]);

        $otherProduct = \App\Models\Product::factory()->create();

        $response = $this->get('/');

        $response->assertDontSee($myProduct->name);

        $response->assertSee($otherProduct->name);
    }
}
