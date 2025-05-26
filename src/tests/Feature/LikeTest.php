<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Like;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_いいね登録と解除ができる()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/item/' . $product->id);
        $response->assertStatus(200);

        $this->post(route('item.toggle_like', $product->id));
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->get('/item/' . $product->id);
        $response->assertSee('class="star-icon liked"', false);

        $this->post(route('item.toggle_like', $product->id));

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->get('/item' . $product->id);
        $response->assertDontSee('class="star-icon liked"', false);
    }
}
