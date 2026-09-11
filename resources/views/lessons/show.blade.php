@extends('layouts.app')

@section('title', $lesson->title)

@section('content')
    <p class="mb-2 text-sm text-slate-500">
        <a href="{{ route('courses.show', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        ·
        <a href="{{ route('courses.modules.show', [$course, $module]) }}" class="hover:text-slate-900">{{ $module->title }}</a>
        · Lesson {{ $lesson->position }}
    </p>

    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <h1 class="text-2xl font-semibold tracking-tight">{{ $lesson->title }}</h1>

        <div class="flex gap-3 text-sm">
            @can('update', $lesson)
                <a href="{{ route('courses.modules.lessons.edit', [$course, $module, $lesson]) }}" class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                    Edit
                </a>
            @endcan
            @can('delete', $lesson)
                <form method="POST" action="{{ route('courses.modules.lessons.destroy', [$course, $module, $lesson]) }}" onsubmit="return confirm('Delete this lesson?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-red-300 px-4 py-2 font-medium text-red-700 hover:bg-red-50">
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <div class="border border-slate-200 bg-white px-4 py-5">
        <h2 class="mb-2 text-sm font-medium text-slate-500">Content</h2>
        <p class="whitespace-pre-wrap text-slate-800">
            {{ $lesson->content ?: 'No content yet.' }}
        </p>
    </div>

    @if ($lesson->notes_path || $lesson->video_url)
    <div class="mt-6 border border-slate-200 bg-white px-4 py-5">
        <h2 class="mb-3 text-sm font-medium text-slate-500">Materials</h2>
        <ul class="space-y-2 text-sm">
            @if ($lesson->notes_path)
                <li>
                    <a href="{{ $lesson->notesUrl() }}" target="_blank" class="font-medium underline">
                        Download / open PDF notes
                    </a>
                </li>
            @endif
            @if ($lesson->video_url)
                <li>
                    <a href="{{ $lesson->video_url }}" target="_blank" rel="noopener noreferrer" class="font-medium underline">
                        Watch video
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif

        @if (auth()->user()->isStudent() && auth()->user()->isEnrolledIn($course))
        <div class="mt-6">
            @if ($isCompleted)
                <p class="mb-3 text-sm font-medium text-emerald-700">Completed</p>
                <form method="POST" action="{{ route('courses.modules.lessons.uncomplete', [$course, $module, $lesson]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Mark as incomplete
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('courses.modules.lessons.complete', [$course, $module, $lesson]) }}">
                    @csrf
                    <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                        Mark as complete
                    </button>
                </form>
            @endif
        </div>
    @endif

    <p class="mt-6">
        <a href="{{ route('courses.modules.show', [$course, $module]) }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to module</a>
    </p>
@endsection
