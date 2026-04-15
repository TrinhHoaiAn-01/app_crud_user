<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiet user | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                <a href="{{ route('home') }}">Home</a> | <strong><a href="{{ route('logout') }}">Dang xuat</a></strong>
            </nav>

            <div class="page-body">
                <section class="page-panel">
                    <h1 class="page-title">Man hinh chi tiet</h1>

                    <div class="detail-grid">
                        <div class="detail-label">Username</div>
                        <div class="detail-value">{{ $user->username }}</div>

                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $user->email }}</div>
                    </div>

                    <div class="form-actions">
                        <a class="button" href="{{ route('users.edit', ['id' => $user->id]) }}">Chinh sua</a>
                    </div>
                </section>
            </div>

            <footer class="footer-bar">Lap trinh web @01/2024</footer>
        </section>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
