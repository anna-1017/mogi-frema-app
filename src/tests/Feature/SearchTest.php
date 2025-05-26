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

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品名で部分一致検索ができる()
    {
        $product1 = \App\Models\Product::factory()->create(['name' -> 'Apple iPhone']);
        $product2 = \App\Models\Product::factory()->create(['name' -> 'Apple watch']);
        $product3 = \App\Models\Product::factory()->create(['name' -> 'Samsung Galaxy']);

        $response = $this->get('/?search=Apple');

        $response->assertStatus(200);

        $response->assertSee($product1->name);
        $response->assertSee($product2->name);

        $response->assertDontSee($product3->name);
    }

    public function test_検索状態がマイリストでも保持されている()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $keyword = 'Apple';

        $response = $this->get("/?search={$keyword}");
        $response->assertStatus(200);
        $response->assertSee($keyword);

        $response = $this->get("/mylist?search={$keyword}");
        $response->assertStatus(200);
        $response->assertSee($keyword);
    }
}
