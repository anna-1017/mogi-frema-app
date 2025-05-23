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
                    
  <div class="product-list {{ request('query') ? 'search-mode' : '' }}">
  @foreach ($items as $item)
    <a href="/item/{{ $item->id }}" class="product-card">
      <div class="product-item">
        <div class="product-img">
          @if (Str::startsWith($item->img_url, 'http'))
            <img class="product-image" src="{{ $item->img_url }}" alt="product{{ $item->name }}" >
          @else
            <img class="product-image" src="{{ asset('storage/' . $item->img_url) }}" alt="produc{{ $item->name }}">
          @endif
        </div>
        <div class="product-name">{{ $item->name }}</div>
      </div>
    </a>
  @endforeach
  </div>

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
@endsection