<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
    @yield('css')

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

            <div>
                @yield('content')
            </div>
        </div>
    </main>
</body>
    
</html>