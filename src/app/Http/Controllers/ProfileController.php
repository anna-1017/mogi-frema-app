<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();// ログイン中のユーザー情報を取得！
        $profile = $user->profile;
        $products = $user->items;

        return view('show_profile', compact('user', 'profile' , 'products'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('edit_profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        $request->validate([
            'name' => 'required|string|max:255',
            'img_url' => 'nullable|url',
        ]);

        $user->name = $request->input('name');
        $user->save();

        if ($profile){
            $profile->img_url = $request->input('img_url');
            $profile->save();
        }else {
            Profile::create([
                'user_id' => $user->id,
                'img_url' => $request->input('img_url')
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました');
    }
}
