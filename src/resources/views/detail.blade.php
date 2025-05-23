@extends('layouts.header-nav')

  @section('title')
  <title>商品詳細画面</title>
  @endsection

  @section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
  @endsection

@section('content')
    <div class="detail">
        <div class="detail__inner">

            <div class="product-img">
                <img class="product-image" src="{{ filter_var($item->img_url, FILTER_VALIDATE_URL) ? $item->img_url : asset('storage/' . $item->img_url) }}" alt="produc{{ $item->name }}">
            </div>

            <div class="detail-item">
                <h2 class="product-name">{{ $item->name }}</h2>
                <div class="brand-name">{{ $item->brand_name }} </div>
                <div class="price">￥{{ number_format($item->price) }}(税込)
            </div>
                  
            <div class="icon-group">
              <div class="icon-count">
                <form action="{{ route('item.toggle_like', ['item_id' => $item->id]) }}" method="POST" class="icon-form">
                @csrf
                  <button type="submit" class="icon-button">
                    <img src="/images/star_icon.png" class="star-icon {{ $liked ? 'liked' : '' }}" alt="いいね">
                    <span>{{ $item->likes_count ?? 0 }}</span>
                  </button>
                </form>
              </div>

              <div class="icon-count">
                <img src="/images/bubble_icon.png" class="bubble-icon">
                <span>{{ $item->comments_count ?? 0 }}</span>
              </div>
            </div>


            <a href="{{ route('purchase.showConfirm', ['item_id' => $item->id]) }}" class="btn">購入手続きへ</a>

            <div class="description">
              <p class="description-title">商品説明</p>
              <p class="description-text">{{ $item->description }}</p>
            </div>

            <div class="information">
              <p class="information-title">商品の情報</p>
                <div class="category-group">
                  <p class="category-text">カテゴリー
                  @foreach($item->categories as $category )
                    <span class="tag">{{ $category->category }}</span>
                  @endforeach
                  </p>
            </div>

            <div class="condition-group">
              <p class="condition-text">商品の状態</p> 
                <p class="condition">
                  @if($item->condition == 'good')
                    良好
                  @elseif($item->condition == 'no_visible_damage')
                    目立った傷や汚れなし
                  @elseif($item->condition == 'some_damage')
                    やや傷や汚れあり
                  @else
                    状態が悪い
                  @endif
                </p>
            </div>          
                  
            <div class="comment-section">
              <p class="comment-title">コメント（{{ $item->comments->count()}}）</p>
              @foreach ($item->comments as $comment)
                  <div class="comment">
                    <div class="comment-user">
                    <img src="{{ $comment->user->profile ? asset('storage/' . $comment->user->profile->img_url) : 'https://placekitten.com/200/200' }}" alt="アイコン" class="user-icon">
                    <p>{{ $comment->user->profile_image }}</p>
                      <span class="user-name">{{ $comment->user->name }}</span>
                    </div>
                          
                      <p class="comment-text">{{ $comment->comment }}</p>
                  </div>
              @endforeach
            </div>


            <div class="comment-form">
              <p class="comment-for-item">商品へのコメント</p>
              <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
              @csrf
                <textarea name="comment" id=""></textarea>
                <button type="submit">コメントを送信する</button>
              </form>
            </div>

        </div>           
    </div>
@endsection