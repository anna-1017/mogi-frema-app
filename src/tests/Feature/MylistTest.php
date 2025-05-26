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

class MylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_いいねした商品だけが表示される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $lokeProduct = Product::factory()->create();
        $unlikeProduct = Product::factory()->create();

        $user->likes()->attach($likedProdust->id);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee($likedProduct->name);
    }

    public function test_購入済みの商品はsoldと表示される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $purchaseProduct = Product::factory()->create([
            'buyer_id' => $user->id,
        ]);

        $user->likes()->attach($purchaseProduct->id);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('sold');
    }

    public function test_自分が出品した商品は表示されない()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $myProduct = Product::factory()->create([
            'user_id' => $user->id,
        ]);
        $user->lkes()->attach($myProduct->id);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertDontSee($myProduct->name);
    }

    public function test_未認証の場合は何も表示されない()
    {
        $product = Product::factory()->create();

        $response = $this->get('/?tab=mylist');

        $response->assertRedirect('login');
    }
}
