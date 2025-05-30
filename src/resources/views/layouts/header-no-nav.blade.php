<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-no-nav.css') }}" />
    @yield('css')

</head>
<body>
    <main class="toppage">
        <div class="toppage__inner">
            <header class="toppage__header">
                <div class="header__inner">
                    <a href="{{ url('/') }}" class="header-logo">
                        <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
                    </a>
                    
                </div>
            </header>

            <div>
                 @yield('content')
            </div>

            
            
            
        </div>
    </main>
    
</body>
</html>