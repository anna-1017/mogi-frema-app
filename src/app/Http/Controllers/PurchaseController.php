<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;

class PurchaseController extends Controller
{

    public function showConfirm($item_id)
    {
        $item = Item::findOrfail($item_id);
        $user = auth()->user();
        $address = $user->profile;
        $payment_method = session('payment_method', '');

        return view('purchase', compact('item', 'address', 'payment_method'));
    }

    public function confirm(Request $request, $item_id)
    {

        $action = $request->input('action');


        if ($action === 'change_address'){
            
            session([
                'postcode' => $request->input('postcode'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
            ]);

            return redirect()->route('address.change', ['item_id' => $item_id]);
        }
        
        if ($action === 'purchase'){
            $user = auth()->user();
            $item = Item::findOrFail($item_id);

            if ($item->status === 'sold_out'){
                return redirect()->back()->with('error', 'この商品はすでに購入されています。');
            }

            \App\Models\Purchase::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);


            $item->status = 'sold_out';
            $item->save();

            session(['payment_method' => $request->input('payment_method')]);

            return redirect()->route('purchase.complete');
        }

        

    }


    public function showPurchasePage()
    { 
        $user =auth()->user();
        $address = $user->profile;

        return view('purchase', compact('address'));
    }
    

    public function complete()
    {
        return view('purchase.complete');
    }
}
