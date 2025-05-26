<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Purchase;


class UpdateAddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_登録した住所が商品購入画面に反映されている()
    {
        $user = User::factory()->create();

        Profile::create([
            'user_id' => $user->id,
            'postcode' => '123-4567',
            'address' => '東京都新宿区',
            'building' => '新宿ビル',
        ]);

        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('purchase.show', ['product' => $product->id]));

        $response->assertStatus(200);
        $response->assertSee('123-4567');
        $response->assertSee('東京都新宿区');
        $response->assertSee('新宿ビル');

    }


    public function test_購入した商品がpurchasesテーブルに保存される()
    {
        $user = User::factory()->create();

        Profile::create([
            'user_id' => $user->id,
            'postcode' => '987-6543',
            'address' => '大阪府大阪市',
            'building' => '梅田ビル',
        ]);

        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('purchase.store', ['product' => $product->id]));
 
        $response->assertStatus(302);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $product->id,
        ]);

    }
}


        

        

        