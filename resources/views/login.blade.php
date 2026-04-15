<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                <a href="{{ url('/') }}">Home</a> | <strong>Dang nhap</strong> | <a href="{{ url('/register') }}">Dang ky</a>
            </nav>

            <div class="page-body">
                <section class="page-panel">
                    <h1 class="page-title">Man hinh dang nhap</h1>

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="form-grid">
                            <label for="login-username">Username</label>
                            <input class="text-input" id="login-username" name="username" type="text" placeholder="Nhap username" value="{{ old('username') }}" required>

                            <label for="login-password">Mat khau</label>
                            <input class="text-input" id="login-password" name="password" type="password" placeholder="Nhap mat khau" required>

                            <label class="checkbox-row">
                                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                <span>Ghi nho dang nhap</span>
                            </label>
                        </div>

                        <div class="form-actions">
                            <a class="button-secondary" href="{{ url('/register') }}">Tao tai khoan</a>
                            <button class="button" type="submit">Dang nhap</button>
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
