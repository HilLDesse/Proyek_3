<!DOCTYPE html>
<html>
<head>
    <title>Edit Activity</title>
</head>
<body>

    <h1>Edit Activity</h1>

    <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($activity->poster_path)
            <div>
                <p>Poster saat ini:</p>

                <img
                    src="{{ asset('storage/' . $activity->poster_path) }}"
                    alt="Poster {{ $activity->title }}"
                    style="max-width: 300px;"
                >
            </div>

            <br>
        @endif

        <button type="submit">Update</button>
    </form>

    <br>

    <a href="{{ route('activities.show', $activity) }}">Kembali ke detail</a>

</body>
</html>