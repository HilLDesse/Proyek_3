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
    <label for="activity_date">Tanggal</label>
    <input
        type="date"
        id="activity_date"
        name="activity_date"
        value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}"
    >

    @error('activity_date')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="category">Kategori</label>
    <input
        type="text"
        id="category"
        name="category"
        value="{{ old('category', $activity->category ?? '') }}"
    >

    @error('category')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="status">Status</label>
    <select id="status" name="status">
        <option value="">-- Pilih Status --</option>

        <option value="Planned"
            {{ old('status', $activity->status ?? '') == 'Planned' ? 'selected' : '' }}>
            Planned
        </option>

        <option value="Ongoing"
            {{ old('status', $activity->status ?? '') == 'Ongoing' ? 'selected' : '' }}>
            Ongoing
        </option>

        <option value="Done"
            {{ old('status', $activity->status ?? '') == 'Done' ? 'selected' : '' }}>
            Done
        </option>
    </select>

    @error('status')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>