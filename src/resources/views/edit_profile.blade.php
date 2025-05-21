@extends('layouts.header-nav')

@section('title')
<title>プロフィール編集画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection

@section('content')
  <div class="profile">
    <div class="profile__inner">
      <h2 class="profile-header">プロフィール設定</h2>
        <form action="/mypage/profile" class="profile-form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-img-wrapper">
          <div class="profile-img">
            <div class="image">
              <img src="{{ $profile && $profile->img_url ? asset('storage/' . $profile->img_url) : 'https://placekitten.com/200/200' }}" alt="プロフィール画像">
            </div>
          </div>
          <label class="select-img">
            画像を選択する
            <input type="file" name="img_url" accept="image/*" style="display: none;">
          </label>
          @error('img_url')
            <span class="input_error">
              <p class="input_error_message">{{ $message }}</p>
            </span>
          @enderror
        </div>

            
          <label class="label">ユーザー名</label>
            <input class="form-input" type="text" name="name" value="{{ old('name', $user->name) }}" />
          @error('name')
            <span class="input_error">
              <p class="input_error_message">{{ $message }}</p>
            </span>
          @enderror

          <label class="label">郵便番号</label>
            <input class="form-input" type="text" name="postcode" value="{{ old('postcode', $profile->postcode ?? '') }}" />
          @error('postcode')
            <span class="input_error">
              <p class="input_error_message">{{ $message }}</p>
            </span>
          @enderror

          <label class="label">住所</label>
            <input class="form-input" type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" />
            @error('address')
              <span class="input_error">
                <p class="input_error_message">{{ $message }}</p>
              </span>
            @enderror

          <label class="label">建物名</label>
            <input class="form-input" type="text" name="building" value="{{ old('building', $profile->building ?? '') }}" />
            @error('building')
              <span class="input_error">
                <p class="input_error_message">{{ $message }}</p>
              </span>
            @enderror

              <button class="form-button" type="submit">更新する</button>

        </form>
        @if(session('success'))
          <div class="alert">
            {{ session('success') }}
          </div>
        @endif
    </div>

        
  </div>
@endsection