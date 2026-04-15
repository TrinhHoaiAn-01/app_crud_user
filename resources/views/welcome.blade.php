<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                @auth
                    <strong>Home</strong> | <a href="{{ route('users.list') }}">Danh sach user</a> | <a href="{{ route('logout') }}">Dang xuat</a>
                @else
                    <strong>Home</strong> | <a href="{{ route('login') }}">Dang nhap</a> | <a href="{{ route('register') }}">Dang ky</a>
                @endauth
            </nav>

            <div class="page-body">
                <section class="welcome-card">
                    <h1 class="page-title">Bai tap EXE01</h1>

                    <div class="quick-links">
                        <a class="quick-link" href="{{ route('login') }}">Mo trang dang nhap</a>
                        <a class="quick-link" href="{{ route('register') }}">Mo trang dang ky</a>
                        <a class="quick-link" href="{{ $sampleUser ? route('users.edit', ['id' => $sampleUser->id]) : route('users.list') }}">Mo trang cap nhat</a>
                        <a class="quick-link" href="{{ route('users.list') }}">Mo danh sach user</a>
                        <a class="quick-link" href="{{ $sampleUser ? route('users.view', ['id' => $sampleUser->id]) : route('users.list') }}">Mo trang chi tiet</a>
                    </div>
                </section>
            </div>

            <footer class="footer-bar">Lap trinh web @01/2024</footer>
        </section>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
