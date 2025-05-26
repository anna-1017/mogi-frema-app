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

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_名前が未入力の時バリデーションエラーになる()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_メールアドレスが未入力の時バリデーションエラーになる()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_パスワードが未入力の時バリデーションエラーになる()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_パスワードが7文字以下の時バリデーションエラーになる()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'pass123',
            'password_confirmation' => 'pass123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_パスワードが確認用パスワードと一致しない時バリデーションエラーになる()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'pass1234',
            'password_confirmation' => 'pass1235',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_全ての入力が正しい場合会員登録され、ログイン画面に遷移される()
    {
        $response = $this->post('/register', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'pass1234',
            'password_confirmation' => 'pass1234',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
