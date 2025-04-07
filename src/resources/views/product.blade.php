<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面（トップ）
    </title>

    <link rel="stylesheet" href="mogi.product.css">

</head>
<body>
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
                <span class="recommend">おすすめ</span>
                <span class="mylist">マイリスト</span>
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
    
</body>
</html>