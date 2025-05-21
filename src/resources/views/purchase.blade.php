@extends('layouts.header-nav')

@section('title')
<title>商品購入画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection

@section('content')
<form action="{{ route('purchase.confirm', ['item_id' => $item->id]) }}" method="POST">
  @csrf
  <div class="purchase">
    <div class="purchase-left-section">
      <div class="item-group">
        <div class="item-img">
          <img src="{{ $item->img_url }}" alt="商品画像" class="image">
        </div>
        <div class="item-name-price">
          <p class="item-name">{{ $item->name }}</p>
          <p class="item-price">￥{{ number_format($item->price) }}</p>
        </div>
      </div>
      <hr>

      <div class="payment-goup">
        <p class="payment-method-label">支払い方法</p>
          <select name="payment_method" id="payment_method">
            <option value="">選択してください</option>
            <option value="1" {{ (session('payment_method') ==1) ? 'selected' : '' }}>コンビニ支払い</option>
            <option value="2" {{ (session('payment_method') ==2) ? 'selected' : '' }}>カード支払い</option>

          </select>
      <hr>
      </div>
                

      <div class="address-group">
        <div class="address-header">
          <p class="address-label">配送先</p>

            <a href="{{ route('address.change', ['item_id' => $item->id]) }}" class="edit-address">変更する</a>
        </div>
                    
        <div class="address-details">
          <div class="postcode">〒{{ $address->postcode }}</div>
          <div class="address">{{ $address->address }}</div>
          <div class="building">{{ $address->building }}</div>
        </div>
      <hr>
      </div>

    </div>

    <div class="purchase-right-section">
      <div class="price-group">
        <p class="price-label">商品代金</p>
        <p class="price">￥{{ number_format($item->price) }}</p>
      </div>

      <div class="payment-confirmation-group">
        <p class="payment-confirmation-label">支払方法</p>
        <p class="payment-confirmation">
          @if(session('payment_method') == 1)
            コンビニ支払い
          @elseif(session('payment_method') == 2)
            カード支払い
          @else
            -
          @endif
        </p>
      </div>

        <button class="purchase-button" type="submit" name="action" value="purchase">購入する</button>
        
    </div>

  </div>
</form>
@endsection        
