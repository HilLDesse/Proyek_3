<!DOCTYPE html>
<html>
<head>
    <title>Edit Activity</title>
</head>
<body>

    <h1>Edit Activity</h1>

    <form action="{{ route('activities.update', $activity) }}" method="POST">
        @csrf
        @method('PUT')

        @include('activities._form')

        <button type="submit">Update</button>
    </form>

    <br>

    <a href="{{ route('activities.show', $activity) }}">Kembali ke detail</a>

</body>
</html>