<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    //購入確認画面
    public function confirm($item_id)
    {
        //商品情報を取得
        $item = Item::find($item_id);

        //購入確認画面に遷移
        return view('purchase.confirm', compact('item'));
    }

    //購入完了処理
    public function complete(Request $request, $item_id)
    {
        //購入処理をここに書く（DBの更新、決済処理など）
        $item = Item::find($item_id);

        //商品のステータス更新（例：購入済み）
        $item->status ='sold';
        $item->save();

        //購入完了ページにリダイレクト
        return redirect()->route('purchase.complete');
    }

    public function confirm($item_id)
    {
        $item = Item::findOrFail($item_id);

        //ユーザーの住所なども一緒に取得（仮）
        $user = auth()->user();
        $postcode = $user->postcode;
        $address = $user->address;
        $buikding = $user->building;

        return view('purchase.confirm', compact('item', 'postcode', 'address', 'building'));
    }
}
