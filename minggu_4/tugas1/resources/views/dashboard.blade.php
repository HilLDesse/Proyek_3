<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h1>Dashboard</h1>

    <p>
        Selamat datang, {{ auth()->user()->nama_lengkap }}!
    </p>

    <p>
        Halaman ini hanya bisa dibuka setelah login.
    </p>

    <p>
        Username: {{ auth()->user()->username }}
    </p>

    <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>