<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'アクセサリー', '時計', '靴', '家電', 'スポーツ', '食料品', 'キッチン用品', 'バッグ', '化粧品',
        ];
        foreach($categories as $category){ 
            Category::create([
                'category' => $category,
            ]);
        }
    }
}
