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