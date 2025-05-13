@extends('layouts.header-nav')

@section('title')
 <title>商品一覧画面（トップ）</title>
@endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    @endsection

    @section('content')
            <div class="heading">
                <a class="recommend @if($tab === 'products') active @endif" href="{{ route('products.index', ['tab' => 'products']) }}">おすすめ</a>
                
                <a class="mylist @if($tab === 'mylist') active @endif" href="{{ route('products.index', ['tab' => 'mylist']) }}">マイリスト</a>
            </div>                
            <hr>
            
                

              <!-- 商品リストの表示 -->
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