<!DOCTYPE html>
<html>
<head>
    <title>Trash Activities</title>
</head>
<body>
    <h1>Trash Activities</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @forelse ($activities as $activity)
        <div>
            <h3>{{ $activity->code }} - {{ $activity->title }}</h3>

            <p>Kategori: {{ $activity->category?->name }}</p>
            <p>Status: {{ $activity->status }}</p>
            <p>Dihapus: {{ $activity->deleted_at }}</p>

            <form
                action="{{ route('activities.restore', $activity->id) }}"
                method="POST"
            >
                @csrf
                <button type="submit">Restore</button>
            </form>
        </div>

        <hr>
    @empty
        <p>Tidak ada activity yang terhapus.</p>
    @endforelse

    {{ $activities->links() }}

    <a href="{{ route('activities.index') }}">
        Kembali ke Activity
    </a>
</body>
</html>