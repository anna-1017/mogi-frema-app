<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入画面
    </title>

    <link rel="stylesheet" href="mogi.purchase.css">

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
        <!--これより上はlayouts -->

        <form action="/purchase/confirm" method="POST">
          @csrf
          <div class="purchase">
            <div class="purchase-left-section">
                <div class="item-group">
                  <div class="item-img">
                      <img src="" alt="商品画像" class="image">
                  </div>
                  <div class="item-name-price">
                    <p class="item-name">商品名</p>
                    <p class="item-price">￥</p>
                  </div>
                </div>
                <hr>

                <div class="payment-goup">
                    <p class="payment-method-label">支払い方法
                    </p>
                        <select name="payment_method" id="payment_method">
                            <option value="">選択してください</option>
                            <option value="1" {{ old('payment_method')==1 ? 'selected' : ' '}}>コンビニ支払い</option>
                            <option value="2" {{( old('payment_method')==2 ? 'selected' : '')}}>カード支払い</option>

                        </select>
                <hr>
                </div>
                

                <div class="address-group">
                    <div class="address-header">
                      <p class="address-label">配送先</p>
                      <a class="edit-address" href="">変更する</a>
                    </div>
                    
                    <div class="address-details">
                      <div class="postcode">{{ $postcode->postcode }}</div>
                      <div class="address">{{ $address->address }}</div>
                      <div class="building">{{ $building->building }}</div>
                    </div>
                  <hr>
                </div>

            </div>

            <div class="purchase-right-section">
                <div class="price-group">
                    <p class="price-label">商品代金</p>
                    <p class="price">{{ $price->price }}</p>
                </div>

                <div class="payment-confirmation-group">
                    <p class="payment-confirmation-label">支払方法</p>
                    <p class="payment-confirmation">{{ （コンビニ払いなど）}}</p>
                </div>

                <button class="purchase-button" type="submit">購入する</button>

            </div>

          </div>
        </form>
        
          
            
            
            
        </div>
    </main>
    
</body>
</html>