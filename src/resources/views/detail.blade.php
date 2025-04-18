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
                      <img class="product-image" src="{{ $item->img_url }}" alt="produc{{ $item->name }}">
                  </div>

                  <div class="detail-item">
                      <h2 class="product-name">商品名がここに入る{{ $item->name }}</h2>
                      <div class="brand-name">{{ $item->brand_name }} </div>
                      <div class="price">￥{{ number_format($item->price) }}(税込)
                  </div>
                  
                  <div class="icon-group">
                      <div class="icon-count">
                          <img src="star_icon.png" class="star-icon">
                          <span>{{ $item->likes_count ?? 0 }}</span>
                      </div>
                      <div class="icon-count">
                          <img src="bubble_icon.png" class="bubble-icon">
                          <span>{{ $item->comments_count ?? 0 }}</span>
                      </div>
                  </div>

                  <form action="{{ route('purchase', ['id' => $item->id]) }}" method="POST" class="purchase">
                      @csrf
                      <button type="submit">購入手続きへ</button>
                  </form>

                  <div class="description">
                      <p class="description-title">商品説明</p>
                      <p class="description-text">{{ $item->description }}</p>
                  </div>

                  <div class="information">
                      <p class="information-title">商品の情報</p>
                      <div class="category-group">
                        <p class="category-text">カテゴリー
                          @foreach($item->categories as $category )
                            <span class="tag">{{ $category->name }}</span>
                          @endforeach
                        </p>
                      </div>
                      <div class="condition-group">
                        <p class="condition-text">商品の状態</p> 
                        <p class="condition">{{ $item->condition }}</p>
                      </div>
                  </div>

                  <div class="comment-section">
                    <p class="comment-title">コメント（{{ $item->comments->count()}}）</p>
                    @foreach ($item->comments as $comment)
                        <div class="comment">
                          <div class="comment-user">
                            <img src="{{ $comment->user->profile_image }}" alt="アイコン" class="user-icon">
                            <span class="user-name">{{ $comment->user->name }}</span>
                          </div>
                          
                          <p class="comment-text">{{ $comment->content }}</p>
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