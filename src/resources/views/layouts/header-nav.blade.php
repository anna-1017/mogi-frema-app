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
                        <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
                    </div>
                    <input class="product-search" type="text" placeholder="　　なにをお探しですか？">
                    <nav class="header__nav">
                        @auth
                          <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                          </form>
                        <a href="/mypage/profile" class="mypage">マイページ</a>
                        <a href="/sell" class="sell">出品</a>
                        @endauth

                        @guest
                          <form action="{{ route('login') }}" method="GET">
                            @csrf
                            <button class="login" type="submit">ログイン</button>
                          </form>
                        <a href="/mypage/profile" class="mypage">マイページ</a>
                        <a href="/sell" class="sell">出品</a>
                        @endguest
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