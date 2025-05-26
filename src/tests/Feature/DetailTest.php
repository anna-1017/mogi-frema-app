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

class DetailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品詳細情報が表示される()
    {
        $user = User::factory()->create();
        $brand = Brand::factory()->create(['name' => 'NIKE']);
        $category1 = Category::factory()->create(['name' => '靴']);

        $product = Product::factory()
            ->for($user)
            ->for($brand)
            ->hasAttached([$category1])
            ->create([
                'name' => 'エアマックス',
                'price' => 12000,
                'description' => 'どんな服にも合わせやすいスニーカーです',
                'condition' => '良好',
            ]);

        $comment = Comment::factory()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'content' => 'お値下げ可能ですか？'
        ]);

        $response = $this->get(route('products.show', $product->id));

        $response->assertStatus(200);
        $response->assertSeeText('エアマックス');
        $response->assertSeeText('NIKE');
        $response->assertSeeText('12000');
        $response->assertSeeText('どんな服にも合わせやすいスニーカーです');
        $response->assertSeeText('良好');
        $response->assertSeeText('靴');
        $response->assertSeeText('お値下げ可能ですか？');
        $response->assertSeeText($user->name);
    }
}
