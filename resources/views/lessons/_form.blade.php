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

<!-- Is demo -->
<div>
<label class="flex items-center gap-2 text-sm">
    <input
        type="checkbox"
        name="is_demo"
        value="1"
        @checked(old('is_demo', $lesson?->is_demo))
    >
    Free demo lesson (visible to guests on preview)
</label>
</div>

<div>
    <label for="notes" class="mb-1 block text-sm font-medium">PDF notes (optional)</label>
    <input
        id="notes"
        type="file"
        name="notes"
        accept="application/pdf,.pdf"
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
    @if ($lesson?->notes_path)
    <p class="mt-2 text-sm">
        Current:
        <a href="{{ $lesson->notesUrl() }}" target="_blank" class="underline">View PDF</a>
    </p>
    <label class="mt-2 flex items-center gap-2 text-sm">
        <input type="checkbox" name="remove_notes" value="1">
        Remove current PDF
    </label>
@endif
</div>

<div>
    <label for="video_url" class="mb-1 block text-sm font-medium">Video URL (optional)</label>
    <input
        id="video_url"
        type="url"
        name="video_url"
        value="{{ old('video_url', $lesson?->video_url) }}"
        placeholder="https://www.youtube.com/watch?v=..."
        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
    >
</div>
