<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sach user | Lap trinh web</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="app-shell">
        <section class="content">
            <nav class="top-nav">
                <a href="{{ url('/') }}">Home</a> | <strong><a href="{{ url('/logout') }}">Dang xuat</a></strong>
            </nav>

            <div class="page-body">
                <section class="page-panel wide">
                    <h1 class="page-title">Danh sach user</h1>

                    @if (session('status'))
                        <div class="helper-text" style="color: #117a37;">{{ session('status') }}</div>
                    @endif

                    <div class="data-table-wrap">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Thao tac</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ url('/update?id=' . $user->id) }}">Edit</a> |
                                            <a href="{{ url('/view?id=' . $user->id) }}">View</a> |
                                            <a href="{{ url('/delete?id=' . $user->id) }}" onclick="return confirm('Ban chac chan muon xoa user nay?');">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Chua co user nao.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        @if ($users->onFirstPage())
                            <button class="page-btn" type="button" disabled>Previous</button>
                        @else
                            <a class="page-btn" href="{{ $users->previousPageUrl() }}">Previous</a>
                        @endif

                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page === $users->currentPage())
                                <button class="page-btn is-active" type="button" disabled>{{ $page }}</button>
                            @else
                                <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($users->hasMorePages())
                            <a class="page-btn" href="{{ $users->nextPageUrl() }}">Next</a>
                        @else
                            <button class="page-btn" type="button" disabled>Next</button>
                        @endif
                    </div>
                </section>
            </div>

            <footer class="footer-bar">Lap trinh web @01/2024</footer>
        </section>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
