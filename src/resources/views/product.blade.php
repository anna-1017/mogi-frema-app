@extends('layouts.header-nav')

    @section('title')
    <title>商品一覧画面（トップ）</title>
    @endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    @endsection

    @section('content')
    <main class="toppage">
        <div class="toppage__inner">
            <header class="toppage__header">
                <div class="header__inner">
                    <div class="header-logo">
                        <img src="logo.svg" alt="logo" class="logo">
                    </div>
                    <input class="product-search" type="text" placeholder="　　なにをお探しですか？">
                    <nav class="header__nav">
                        <a href="" class="login">ログイン</a>
                        <a href="" class="mypage">マイページ</a>
                        <a href="" class="sell">出品</a>
                        

                    </nav>
                </div>
            </header>

            <div class="heading">
                <a class="recommend" href="/">おすすめ</a>
                <a class="mylist" href="/?tab=mylist">マイリスト</a>
            </div>                
            <hr>
            <div class="product-list">
                @foreach ($products as $product)
                <div class="product-item">
                    <div class="product-img">
                        <img class="product-image" src="{{ $product->image_url }}" alt="produc{{ $product->name }}">
                    </div>
                    <div class="product-name">{{ $product->name }}</div>
                </div>
                @endforeach
            </div>
            
            
        </div>
    </main>
    @endsection