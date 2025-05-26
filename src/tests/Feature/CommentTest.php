<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ログイン済みユーザーはコメントを送信できる()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        
        $this->actingAs($user);

        $response = $this->post(route('comment.store', $product->id), [
            'comment' => 'テストコメントです',
        ]);

        $response->assertRedirest();
        $this->assertDatabaseHas('comments' [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'comment' => 'テストコメントです',
        ]);
    }

    public function test_未ログインユーザーはコメントを送信できない()
    {
        $product = Product::factory()->create();

        $response = $this->post(route('comment.store', $product->id),[
            'comment' => 'ログインしてないコメント',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('comments', [
            'comment' => 'ログインしてないコメント',
        ]);
    }

    public function test_コメントが未入力ならバリデーションメッセージが表示される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comment.store',$product->id), [
            'comment' => ''
        ]);
    }

    public function test_コメントが255文字以上の場合バリデーションメッセージが表示される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $loginCommnet =str_repeat('あ', 256);

        $response = $this->post(route('comment.store', $product->id), [
            'comment' => $longComment,
        ]);

        $response->assertSessionHasErrors('comment');
        $this->assertDatabaseMissing('comments', [
            'user_id' => $user-> id,
            'product_id' => $product->id,
        ]);
    }
}
