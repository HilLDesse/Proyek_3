<!DOCTYPE html>
<html>
<head>
    <title>Daftar Activities</title>
</head>
<body>
    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <h1>Daftar Activities</h1>

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

    <h2>Daftar Kategori</h2>

    @foreach ($categories as $category)
        <div>
            <span>{{ $category->name }}</span>

            <form
                action="{{ route('categories.destroy', $category) }}"
                method="POST"
                style="display: inline;"
                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit">Hapus Kategori</button>
            </form>
        </div>

        <br>
    @endforeach

    <hr>

    @forelse ($activities as $activity)

        <h2>{{ $activity->title }}</h2>

        <p>{{ $activity->description }}</p>

        <p>
            Tanggal:
            {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
        </p>

        <p>Kode: {{ $activity->code }}</p>

        <p>Kategori: {{ $activity->category->name }}</p>

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