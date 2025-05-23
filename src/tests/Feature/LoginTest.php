<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_メールアドレスが入力されていない時バリデーションエラーになる()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_パスワードが入力されていない時バリデーションエラーになる()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_メールアドレスが間違っている時ログインに失敗しエラーメッセージが表示される()
    {
        $response = $this->form('/login')->post('/login', [
            'email' => 'notfound@example.com',
            'password' => 'somepassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_パスワードが間違っている時ログインに失敗しエラーメッセージが表示される()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
    }

    public function test_全ての入力が正しい場合ログイン処理が実行される()
    {

        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('pass1234'),
        ]);

        $response = $this->post('/login',[
            'email' => 'test@example.com',
            'password' => 'pass1234',
        ]);

        $response->assertRedirect('/home');

        $this->assertAuthenticatedAs($user);
        
    }
}
