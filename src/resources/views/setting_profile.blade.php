@extends('layouts.header-nav')<!--これいらないかも？？ -->

    @section('title')
    <title>プロフィール設定画面_初回ログイン時</title>
    @endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/eprofile.setting.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
    @endsection

    @section('content')
            <div class="profile">
                <div class="profile__inner">
                    <h2 class="profile-header">プロフィール設定</h2>
                    <div class="profile-img-wrapper">
                      <div class="profile-img">
                        <div class="image">
                            <img src="" alt="">
                        </div>
                      </div>
                      <span class="select-img">画像を選択する</span>
                    </div>

                    <form action="/mypage/profile" class="profile-form" method="POST">
                        @csrf
                        <label class="label">ユーザー名</label>
                        <input class="form-input" type="text" name="name" value="{{ old('name') }}" />
                        @error('name')
                        <span class="input_error">
                            <p class="input_error_message">{{ $message }}</p>
                        </span>
                        @enderror

                        <label class="label">郵便番号</label>
                        <input class="form-input" type="text" name="postcode" value="{{ old('postcode') }}" />
                        @error('postcode')
                        <span class="input_error">
                            <p class="input_error_message">{{ $message }}</p>
                        </span>
                        @enderror

                        <label class="label">住所</label>
                        <input class="form-input" type="text" name="address" value="{{ old('address') }}" />
                        @error('address')
                        <span class="input_error">
                            <p class="input_error_message">{{ $message }}</p>
                        </span>
                        @enderror

                        <label class="label">建物名</label>
                        <input class="form-input" type="text" name="building" value="{{ old('building') }}" />
                        @error('building')
                        <span class="input_error">
                            <p class="input_error_message">{{ $message }}</p>
                        </span>
                        @enderror

                        <button class="form-button" type="submit">更新する</button>

                    </form>
                </div>
            </div>
    @endsection