<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <p>Masuk untuk membuka dashboard</p>

    @if ($errors->has('login'))
        <p style="color: red;">
            {{ $errors->first('login') }}
        </p>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <p>
            <label for="username">Username</label><br>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                required
            >
        </p>

        <p>
            <label for="password">Password</label><br>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </p>

        <button type="submit">Masuk</button>
    </form>

</body>
</html>