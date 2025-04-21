<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('product', compact('items'));
    }

    public function getDetail(Item $item)
    {
        $item->load('categories'); //この $item に関連付けられた categories を あらかじめ取得しておくよ！という命令
        return view('detail', compact('item'));
    }
}
