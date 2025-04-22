@extends('layouts.header-nav')

@section('title')
商品一覧画面（トップ）
@endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    @endsection

    @section('content')
            <div class="heading">
                <a class="recommend" href="/">おすすめ</a>
                <a class="mylist" href="/?tab=mylist">マイリスト</a>
            </div>                
            <hr>
            <div class="product-list {{ request('query') ? 'search-mode' : '' }}">
                @foreach ($items as $item)
                <a href="/item/{{ $item->id }}" class="product-card">
                  <div class="product-item">
                    <div class="product-img">
                        <img class="product-image" src="{{ $item->img_url }}" alt="produc{{ $item->name }}">
                    </div>
                    <div class="product-name">{{ $item->name }}</div>
                  </div>
                </a>
                @endforeach
              
            </div>
    @endsection