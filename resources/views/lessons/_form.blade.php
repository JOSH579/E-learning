@php
    $lesson = $lesson ?? null;
@endphp

<div>
    <label for="title" class="mb-1 block text-sm font-medium">Title</label>
    <input
        id="title"
        type="text"
        name="title"
        value="{{ old('title', $lesson?->title) }}"
        required
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
</div>

<div>
    <label for="content" class="mb-1 block text-sm font-medium">Content</label>
    <textarea
        id="content"
        name="content"
        rows="8"
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >{{ old('content', $lesson?->content) }}</textarea>
</div>

<div>
    <label for="position" class="mb-1 block text-sm font-medium">Position</label>
    <input
        id="position"
        type="number"
        name="position"
        min="1"
        value="{{ old('position', $lesson?->position ?? $nextPosition ?? 1) }}"
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
    <p class="mt-1 text-xs text-slate-500">Lower numbers appear first in the course.</p>
</div>
