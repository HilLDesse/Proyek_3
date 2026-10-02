<div>
    <label for="code">Kode Activity</label>
    <input
        type="text"
        id="code"
        name="code"
        value="{{ old('code', $activity->code ?? '') }}"
    >

    @error('code')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">-- Pilih Kategori --</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id', $activity->category_id ?? '') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="title">Judul</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $activity->title ?? '') }}"
    >

    @error('title')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="description">Deskripsi</label>
    <textarea
        id="description"
        name="description"
    >{{ old('description', $activity->description ?? '') }}</textarea>

    @error('description')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="start_at">Tanggal Mulai</label>
    <input
        type="date"
        id="start_at"
        name="start_at"
        value="{{ old('start_at', isset($activity) && $activity->start_at ? $activity->start_at->format('Y-m-d') : '') }}"
    >

    @error('start_at')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="end_at">Tanggal Selesai</label>
    <input
        type="date"
        id="end_at"
        name="end_at"
        value="{{ old('end_at', isset($activity) && $activity->end_at ? $activity->end_at->format('Y-m-d') : '') }}"
    >

    @error('end_at')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="location">Lokasi</label>
    <input
        type="text"
        id="location"
        name="location"
        value="{{ old('location', $activity->location ?? '') }}"
    >

    @error('location')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="capacity">Kapasitas</label>
    <input
        type="number"
        id="capacity"
        name="capacity"
        min="1"
        max="500"
        value="{{ old('capacity', $activity->capacity ?? '') }}"
    >

    @error('capacity')
        <p>{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="poster">Poster</label>

    <input
        type="file"
        id="poster"
        name="poster"
        accept="image/*"
    >

    @error('poster')
        <div>{{ $message }}</div>
    @enderror
</div>

<br>