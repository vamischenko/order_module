<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Сервисный центр')</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        header {
            background: #2563eb;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.4rem;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
        }

        header nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 1.5rem;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        header nav a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .nav-logout {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.6);
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.95rem;
            cursor: pointer;
            margin-left: 1.5rem;
            opacity: 0.9;
            transition: opacity 0.2s, background 0.2s;
        }

        .nav-logout:hover {
            opacity: 1;
            background: rgba(255,255,255,0.15);
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.85rem;
            color: #888;
            border-top: 1px solid #e2e8f0;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }

            header nav a {
                margin-left: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="logo">СервисПро</a>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            @auth
                <a href="{{ route('orders.list') }}">Заявки</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="nav-logout">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}">Войти</a>
            @endauth
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Мищенко В.А.
    </footer>
</body>
</html>
