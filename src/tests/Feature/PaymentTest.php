<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\PaymentMethod;

class PaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_支払い方法を選択すると小計画面に即時反映される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'price' => 5000,
        ]);

        $conveniencestore = PaymentMethod::create(['name' => 'コンビニ支払い']);
        $card = PaymentMethod::create(['name' => 'カード支払い']);

        $this->actingAs($user);

        $response = $this->get(route('purchase.show', ['product' => $product->id]));
        $response->assertStatus(200);

        $response = $this->post(route('purchase.set_payment_method'), [
            'payment_method_id' => $card->id,
        ]);

        $response->assertStatus(200);

        $response = $this->get(route('purchase.confirm', ['product' => $product->id]));
        $response->assertSee('カード支払い');
    }
}
