<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;


class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_購入するボタンで購入が完了する()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'is_sold' => false,
        ]);

        $this->astingAs($user);

        $response = $this->post(route('purchase.store', $product->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_sold' => true,
        ]);
    }

    public function test_購入後の商品一覧でsoldと表示される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['is_sold' => false]);

        $this->actingAs($user);

        $this->post(route('purchase.store', $product->id));

        $response = $this->get(route('product.index'));

        $response->assertSee('class="sold"', false);
    }

    public function test_購入後プロフィールに商品が追加される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['is_sold' => false]);

        $this->actingAs($user);

        $this->post(route('purchase.store', $product->id));

        $response->assertStasus(200);
        $response->assertSee($product->name);
    }
}
