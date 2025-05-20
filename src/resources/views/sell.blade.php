@extends('layouts.header-nav')

@section('title')
<title>商品出品画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection

@section('content')
    <div class="sell">
            <div class="sell__inner">
                <h2>商品の出品</h2>

                <form action="{{ route('items.store') }}" class="sell-form" method="POST" enctype="multipart/form-data">
                @csrf 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="img-group">
                        <div class="sell-img-label">商品画像</div>
                        <div class="img-upload-box">
                            <label for="product-image" class="upload-label">画像を選択する
                              <input type="file" id="product-image" class="upload-input" name="img_url">
                            </label>
                          @if (!empty($item->img_url))  
                            <img src="{{ asset('storage/' . $item->img_url) }}" alt="">
                          @endif
                        </div>
                        
                    </div>   

                    <div class="detail-group">
                        <div class="detail-group-title">
                            商品の詳細
                        </div>
                        <hr>

                        <div class="detail-category">
                            <div class="category-title">カテゴリー</div>
                            <div class="category-select-group">
                                @foreach ($categories as $index => $category)
                                    <input type="radio" id="cat{{ $index }}" name="category" value="{{ $category }}">
                                    <label for="cat{{ $index }}">{{ $category }}</label>
                                @endforeach
                                <!--カテゴリー動的にしない場合 
                                <input type="radio" id="cat1" name="category" value="アクセサリー">
                                <label for="cat1">アクセサリー</label>
                                
                                <input type="radio" id="cat2" name="category" value="時計">
                                <label for="cat2">時計</label>

                                <input type="radio" id="cat3" name="category" value="靴">
                                <label for="cat3">靴</label>

                                <input type="radio" id="cat4" name="category" value="家電">
                                <label for="cat4">家電</label>

                                <input type="radio" id="cat5" name="category" value="スポーツ">
                                <label for="cat5">スポーツ</label>

                                <input type="radio" id="cat6" name="category" value="食料品">
                                <label for="cat6">食料品</label>

                                <input type="radio" id="cat7" name="category" value="キッチン用品">
                                <label for="cat">キッチン用品</label>
                                
                                <input type="radio" id="cat8" name="category" value="バッグ">
                                <label for="cat8">バッグ</label>

                                <input type="radio" id="cat9" name="category" value="化粧品">
                                <label for="cat9">化粧品</label>
                                -->

                            </div>
                           
                        </div>

                        <div class="detail-condition">
                            <div class="condition-title">
                                商品の状態
                            </div>
                            <select name="condition" id="condition" class="condition">
                                <option value="">選択してください</option>
                                <option value="good">良好</option>
                                <option value="no_visible_damage">目立った傷や汚れなし</option>
                                <option value="some_damage">やや傷や汚れあり</option>
                                <option value="bad">状態が悪い</option>
                            </select>
                        </div>
                    </div>

                    <div class="description-group">
                        <div class="description-group-title">
                            商品名と説明
                        </div>
                        <hr>

                        <div class="description-name">
                            <div class="name-title">
                                商品名
                            </div>
                            <input type="text" name="name">
                        </div>

                        <div class="description-brand">
                            <div class="brand-title">
                                ブランド名
                            </div>
                            <input type="text" name="brand_name">
                        </div>

                        <div class="description-text">
                            <div class="text-title">
                                商品の説明
                            </div>
                            <textarea name="description" id=""></textarea>
                        </div>

                        <div class="description-price">
                            <div class="price-title">販売価格</div>
                            <div class="price-input-wrapper">
                                <span class="yen">￥</span>
                                <input type="text" name="price">
                            </div>
                        </div>
                        
                    </div>

                    <button type="submit">出品する</button>
                </form>
                

            </div>


    </div>
    @endsection