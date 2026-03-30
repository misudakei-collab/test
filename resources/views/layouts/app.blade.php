<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner" style="display: flex; align-items: center; justify-content: space-between; padding: 20px 40px;">

            <div style="flex: 1;"></div>

            <div style="flex: 1; text-align: center;">
                <a class="header__logo" href="/" style="text-decoration: none; color: #8b7969; font-size: 26px; font-family: 'Garamond', serif;">
                    FashionablyLate
                </a>
            </div>

            <nav style="flex: 1; text-align: right;">
                @if (Auth::check())
                    {{-- ログインしている時 --}}
                    <form action="/logout" method="post" style="display: inline;">
                        @csrf
                        <button class="header__logout-btn" type="submit">logout</button>
                    </form>
                @else
                    {{-- ログインしていない時 --}}
                    @if (Request::is('login'))
                        {{-- ログイン画面にいるときは register ボタンを表示 --}}
                        <a href="/register" class="header__logout-btn" style="text-decoration: none; display: inline-block; line-height: 1;">register</a>
                    @elseif (Request::is('register'))
                        {{-- 登録画面にいるときは login ボタンを表示 --}}
                        <a href="/login" class="header__logout-btn" style="text-decoration: none; display: inline-block; line-height: 1;">login</a>
                    @endif
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
