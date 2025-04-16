<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        // これは仮だから後で消す
        $products = [
            (object)['name' => 'テスト商品1', 'image_url' => 'https://via.placeholder.com/150'],
            (object)['name' => 'テスト商品2', 'image_url' => 'https://via.placeholder.com/150'],
        ];


        //$products = Item::all();　こっちをあとで残す

        return view('product', compact('products'));
    }
}
