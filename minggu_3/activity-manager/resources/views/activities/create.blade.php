<!DOCTYPE html>
<html>
<head>
    <title>Tambah Activity</title>
</head>
<body>

    <h1>Tambah Activity</h1>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf

        @include('activities._form')

        <button type="submit">Simpan</button>
    </form>

    <br>

    <a href="{{ route('activities.index') }}">Kembali ke daftar</a>

</body>
</html>