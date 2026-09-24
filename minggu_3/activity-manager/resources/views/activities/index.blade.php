<!DOCTYPE html>
<html>
<head>
    <title>Daftar Activities</title>
</head>
<body>

    <h1>Daftar Activities</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="GET" action="{{ route('activities.index') }}">
        <label for="status">Filter Status:</label>

        <select name="status" id="status">
            <option value="">Semua</option>

            <option value="Planned" {{ $status === 'Planned' ? 'selected' : '' }}>
                Planned
            </option>

            <option value="Ongoing" {{ $status === 'Ongoing' ? 'selected' : '' }}>
                Ongoing
            </option>

            <option value="Done" {{ $status === 'Done' ? 'selected' : '' }}>
                Done
            </option>
        </select>

        <button type="submit">Filter</button>
    </form>

    <hr>

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