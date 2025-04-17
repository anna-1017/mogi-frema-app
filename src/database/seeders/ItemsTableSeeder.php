<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Armani', 'Rolex', 'Seiko', 'Casio', 'Lenovo', 'Sony', 'Kose',];

        DB::table('items')->insert([
            [  
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => '腕時計',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'condition' => 'good',
                'status' => 'on_sale',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'HDD',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'condition' => 'no_visible_damage',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => '玉ねぎ3束',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'condition' => 'some_damage',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => '革靴',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'condition' => 'bad',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'ノートPC',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'condition' => 'good',
                'status' => 'sold_out', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'マイク',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'condition' => 'no_visible_damage',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'ショルダーバッグ',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'condition' => 'some_damage',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'タンブラー',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'condition' => 'bad',
                'status' =>'sold_out', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'コーヒーミル',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'condition' => 'good',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

              [
                'user_id' => User::inRandomOrder()->first()->id,
                'name' => 'メイクセット',
                'brand_name' => $brands[array_rand($brands)],
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'img_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'condition' => 'no_visible_damage',
                'status' => 'on_sale', 
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
