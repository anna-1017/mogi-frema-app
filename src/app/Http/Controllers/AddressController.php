<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class AddressController extends Controller
{
    public function change(Request $request)
    {
        session([
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'payment_method' => $request->input('payment_method'),
        ]);

        return redirect()->back();
    }

    public function showChangeForm($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();
        $address = $user->profile;

        return view('update_address', compact('item', 'address'));
    }

}
