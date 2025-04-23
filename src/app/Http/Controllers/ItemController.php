<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); 

        if(!empty($query)){
            $items = Item::search($query)->get();
        } else {
            $items = Item::all();
        }

        return view('product', compact('items'));

    }

    public function getDetail(Item $item)
    {
        $item->loadCount('comments');//コメント数カウント反映のため
        $item->load('categories'); //この $item に関連付けられた categories を あらかじめ取得しておくよ！という命令

        $item->loadCount('likes'); 

        return view('detail', compact('item'));
    }

    public function toggleLike($item_id)
    {

        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        //すでに「いいね」してたら削除、なければ追加
        if($item->likes()->where('user_id', $user->id)->exists()){
            $item->likes()->where('user_id', $user->id)->delete();
        } else{
            $item->likes()->create(['user_id' => $user->id]);
        }

        

        return back();//もとのページに戻る

    }
}




