<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang ky | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                <a href="{{ url('/') }}">Home</a> | <a href="{{ url('/login') }}">Dang nhap</a> | <strong>Dang ky</strong>
            </nav>

            <div class="page-body">
                <section class="page-panel">
                    <h1 class="page-title">Man hinh dang ky</h1>

                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="form-grid">
                            <label for="register-username">Username</label>
                            <input class="text-input" id="register-username" name="username" type="text" placeholder="Nhap username" value="{{ old('username') }}" required>

                            <label for="register-password">Mat khau</label>
                            <input class="text-input" id="register-password" name="password" type="password" placeholder="Nhap mat khau" required>

                            <label for="register-confirm">Nhap lai mat khau</label>
                            <input class="text-input" id="register-confirm" name="confirm_password" type="password" placeholder="Nhap lai mat khau" required>

                            <label for="register-email">Email</label>
                            <input class="text-input" id="register-email" name="email" type="email" placeholder="Nhap email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-actions">
                            <a class="button-secondary" href="{{ url('/login') }}">Da co tai khoan</a>
                            <button class="button" type="submit">Dang ky</button>
                        </div>

                        <div class="form-message" aria-live="polite">
                            @if ($errors->any())
                                {{ $errors->first() }}
                            @elseif (session('status'))
                                <span style="color: #117a37;">{{ session('status') }}</span>
                            @endif
                        </div>
                    </form>
                </section>
            </div>

            <footer class="footer-bar">Lap trinh web @01/2024</footer>
        </section>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
