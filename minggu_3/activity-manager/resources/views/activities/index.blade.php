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
        <div>
            <label for="search">Search:</label>
            <input
                type="text"
                id="search"
                name="search"
                value="{{ $search }}"
                placeholder="Cari kode atau judul"
            >
        </div>

        <br>

        <div>
            <label for="category_id">Kategori:</label>
            <select name="category_id" id="category_id">
                <option value="">Semua Kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="status">Status:</label>

            <select name="status" id="status">
                <option value="">Semua Status</option>

                <option
                    value="draft"
                    {{ $status === 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ $status === 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

                <option
                    value="completed"
                    {{ $status === 'completed' ? 'selected' : '' }}
                >
                    Completed
                </option>
            </select>
        </div>

        <br>

        <div>
            <label for="sort">Urutan:</label>

            <select name="sort" id="sort">
                <option
                    value="newest"
                    {{ $sort === 'newest' ? 'selected' : '' }}
                >
                    Terbaru
                </option>

                <option
                    value="oldest"
                    {{ $sort === 'oldest' ? 'selected' : '' }}
                >
                    Terlama
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Terapkan</button>
    </form>

    <hr>

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

        <p>Kode: {{ $activity->code }}</p>

        <p>Kategori: {{ $activity->category->name }}</p>

        <p>
            Mulai:
            {{ $activity->start_at->format('d M Y') }}
        </p>

        <p>
            Selesai:
            {{ $activity->end_at->format('d M Y') }}
        </p>

        <p>Lokasi: {{ $activity->location }}</p>

        <p>Kapasitas: {{ $activity->capacity }}</p>

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

    {{ $activities->links() }}

</body>
</html>