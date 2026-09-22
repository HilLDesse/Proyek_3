<!DOCTYPE html>
<html>
<head>
    <title>Daftar Activities</title>
</head>
<body>

    <h1>Daftar Activities</h1>

    @forelse ($activities as $activity)

        <h2>{{ $activity->title }}</h2>

        <p>{{ $activity->description }}</p>

        <p>
            Tanggal:
            {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
        </p>

        <p>Kategori: {{ $activity->category }}</p>

        <p>Status: {{ $activity->status }}</p>

        <p>
            <a href="{{ route('activities.show', $activity) }}">
                Lihat Detail
            </a>
        </p>

        <hr>

    @empty

        <p>Belum ada kegiatan.</p>

    @endforelse

</body>
</html>