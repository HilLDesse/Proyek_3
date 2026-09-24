<!DOCTYPE html>
<html>
<head>
    <title>Detail Activity</title>
</head>
<body>

    <h1>{{ $activity->title }}</h1>

    <p>{{ $activity->description }}</p>

    <p>
        Tanggal:
        {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
    </p>

    <p>Kategori: {{ $activity->category }}</p>

    <p>Status: {{ $activity->status }}</p>

    <hr>

    <a href="{{ route('activities.edit', $activity) }}">
    Edit
    </a>

    <br>
    <br>
    <form
        action="{{ route('activities.destroy', $activity) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus activity ini?')"
    >
        @csrf
        @method('DELETE')

        <button type="submit">Hapus</button>
    </form>

    <br>
    <a href="{{ route('activities.index') }}">Kembali ke daftar</a>

</body>
</html>