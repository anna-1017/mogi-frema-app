@extends('layouts.header-nav')

@section('title')
<title>プロフィール画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/show_profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection

@section('content')
<div class="profile">
  <div class="profile__inner">
    <div class="profile-img-wrapper">
      <div class="profile-img">
        <div class="image">
          <img src="{{ $profile ? asset('storage/' . $profile->img_url) : 'https://placekitten.com/200/200' }}" alt="user-icon">
        </div>
      </div>
      <p class="user-name">{{ $user->name }}</p>

      <a href="/mypage/profile" class="edit-profile">プロフィールを編集</a>
    </div>
         

    <div class="buy-sell-items">
      <a class="sell-items" href="/mypage?tab=sell">出品した商品</a>
      <a class="buy-items" href="/mypage?tab=buy">購入した商品</a>   
    <hr>
    </div>               
             

    <div class="product-list">
    @foreach ($products as $product)
      <div class="product-item">
        <div class="product-img">
          <img class="product-image" src="{{ $product->img_url }}" alt="{{ $product->name }}">
        </div>
        <div class="product-name">{{ $product->name }}</div>
      </div>
    @endforeach
    </div>

  </div>          
</div>
@endsection