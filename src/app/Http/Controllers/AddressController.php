<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AddressController extends Controller
{
    public function change(Request $request)
    {
        //バリデーションや保存処理など
        session([
            'postcode' => $request->input('postcode'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'payment_method' => $request->input('payment_method'),
        ]);

        return redirect()->back();
    }
}
