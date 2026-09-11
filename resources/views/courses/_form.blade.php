@php
    $course = $course ?? null;
@endphp

<div>
    <label for="title" class="mb-1 block text-sm font-medium">Title</label>
    <input
        id="title"
        type="text"
        name="title"
        value="{{ old('title', $course?->title) }}"
        required
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
</div>

<div>
    <label for="description" class="mb-1 block text-sm font-medium">Description</label>
    <textarea
        id="description"
        name="description"
        rows="5"
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >{{ old('description', $course?->description) }}</textarea>
</div>

<!-- Image upload -->
<div>
    <label for="image" class="mb-1 block text-sm font-medium">Course image</label>
    <input id="image" type="file" name="image" accept="image/*"
           class="w-full border border-slate-300 bg-white px-3 py-2 text-sm">
    @if ($course?->image_path)
        <img src="{{ asset('storage/'.$course->image_path) }}" alt="" class="mt-2 h-24 w-auto object-cover">
    @endif
</div>

<div>
    <label for="price" class="mb-1 block text-sm font-medium">Price</label>
    <input
        id="price"
        type="number"
        name="price"
        step="0.01"
        min="0"
        value="{{ old('price', $course?->price ?? '0.00') }}"
        required
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
</div>

<div>
    <label for="status" class="mb-1 block text-sm font-medium">Status</label>
    <select
        id="status"
        name="status"
        required
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
        @foreach ($statuses as $status)
            <option
                value="{{ $status->value }}"
                @selected(old('status', $course?->status?->value ?? 'draft') === $status->value)
            >
                {{ ucfirst($status->value) }}
            </option>
        @endforeach
    </select>

    <div>
        <label for="category" class="mb-1 block text-sm font-medium">Category</label>
        <select id="category" name="category" class="w-full border border-slate-300 bg-white px-3 py-2 text-sm">
            <option value="">— None —</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->value }}"
                    @selected(old('category', $course?->category?->value) === $category->value)
                >
                    {{ $category->label() }}
                </option>
            @endforeach
        </select>
    </div>
</div>
