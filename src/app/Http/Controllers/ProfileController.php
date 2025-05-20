<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load(['profile', 'items', 'purchases']);// ログイン中のユーザー情報を取得！
        $profile = $user->profile;
        $products = request('tab') === 'buy' ? $user->purchases : $user->items;

        return view('show_profile', compact('user', 'profile' , 'products'));

    }



    public function editProfile()
    {
        $user = auth()->user();  
        $profile = $user->profile;  

        return view('edit_profile', compact('user', 'profile')); 
    }

    public function updateProfile(ProfileRequest $request)
    {
        $validated = $request->validated();  //バリデーション済みのデータを取得

        $user = auth()->user();  // 現在ログインしているユーザーを取得

        $user->name = $validated['name'];
        $user->save();  // ユーザー名は User モデルに保存

        //プロフィール情報を更新（なければ新規作成）
        $profile = $user->profile ?? new Profile();
        $profile->user_id = $user->id;
        $profile->postcode = $validated['postcode'];
        $profile->address = $validated['address'];
        $profile->building = $validated['building'] ?? null;

        //画像がアップロードされていれば保存
        if($request->hasFile('img_url')){
            $image = $request->file('img_url');
            $imagePath = $image->store('profile_images', 'public');  // 'profile_images'というディレクトリに保存

            $profile->img_url = $imagePath;  //画像パスをDBに保存
        }

        $profile->save();  //プロフィール情報を保存

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました');
    }

    public function updateAddress(Request $request, Item $item)
    {
        $request->validate([
            'postcode' => 'required|string|max:8',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase.showConfirm', ['item_id' => $item->id]);

    }
}
