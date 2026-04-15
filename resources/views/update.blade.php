<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cap nhat | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                <a href="{{ route('home') }}">Home</a> | <a href="{{ route('users.list') }}">Danh sach user</a> | <strong>Cap nhat</strong> | <a href="{{ route('logout') }}">Dang xuat</a>
            </nav>

            <div class="page-body">
                <section class="page-panel">
                    <h1 class="page-title">Man hinh cap nhat</h1>

                    <form method="POST" action="{{ route('users.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ old('id', $user->id ?? request('id')) }}">

                        <div class="form-grid">
                            <label for="update-username">Username</label>
                            <input class="text-input" id="update-username" name="username" type="text" value="{{ old('username', $user->username ?? '') }}" required>

                            <label for="update-password">Mat khau</label>
                            <input class="text-input" id="update-password" name="password" type="password" placeholder="Nhap mat khau moi" required>

                            <label for="update-confirm">Nhap lai mat khau</label>
                            <input class="text-input" id="update-confirm" name="confirm_password" type="password" placeholder="Nhap lai mat khau moi" required>

                            <label for="update-email">Email</label>
                            <input class="text-input" id="update-email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required>
                        </div>

                        <div class="form-actions">
                            <a class="button-secondary" href="{{ route('users.list') }}">Quay lai danh sach</a>
                            <button class="button" type="submit">Cap nhat</button>
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
