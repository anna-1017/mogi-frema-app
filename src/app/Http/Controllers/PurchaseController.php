<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{

    public function confirm(Request $request)
    {

        $action = $request->input('antion');

        if ($action === 'change_address'){
            //入力された配送先をセッションの保存
            session([
                'postcode' => $request->input('postcode'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
            ]);

            return redirect()->back();
        }
        
        if ($action === 'purchase'){
            
            //成功したら購入完了画面へ
            return redirect()->route('purchase.complete');
        }
    }
}
