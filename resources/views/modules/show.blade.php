@extends('layouts.app')

@section('title', $module->title)

@section('content')
    <p class="mb-2 text-sm text-slate-500">
        <a href="{{ route('courses.show', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        · Module {{ $module->position }}
    </p>

    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ $module->title }}</h1>
            @if ($module->description)
                <p class="mt-2 whitespace-pre-wrap text-sm text-slate-600">{{ $module->description }}</p>
            @endif
        </div>

        <div class="flex gap-3 text-sm">
            @can('update', $module)
                <a href="{{ route('courses.modules.edit', [$course, $module]) }}" class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                    Edit
                </a>
            @endcan
            @can('delete', $module)
                <form method="POST" action="{{ route('courses.modules.destroy', [$course, $module]) }}" onsubmit="return confirm('Delete this module and its lessons?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-red-300 px-4 py-2 font-medium text-red-700 hover:bg-red-50">
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <div class="mb-4 flex items-center justify-between gap-4">
        <h2 class="text-lg font-semibold tracking-tight">Lessons</h2>
        @can('update', $module)
            <a href="{{ route('courses.modules.lessons.create', [$course, $module]) }}" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Add lesson
            </a>
        @endcan
    </div>

    @if ($module->lessons->isEmpty())
        <p class="text-slate-600">No lessons yet.</p>
    @else
        <div class="overflow-x-auto border border-slate-200 bg-white">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">#</th>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($module->lessons as $lesson)
                        <tr class="border-b border-slate-100">
                            <td class="px-4 py-3 text-slate-500">{{ $lesson->position }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('courses.modules.lessons.show', [$course, $module, $lesson]) }}" class="font-medium hover:underline">
                                    {{ $lesson->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('courses.modules.lessons.show', [$course, $module, $lesson]) }}" class="text-slate-600 hover:text-slate-900">View</a>
                                    @can('update', $lesson)
                                        <a href="{{ route('courses.modules.lessons.edit', [$course, $module, $lesson]) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                                    @endcan
                                    @can('delete', $lesson)
                                        <form method="POST" action="{{ route('courses.modules.lessons.destroy', [$course, $module, $lesson]) }}" onsubmit="return confirm('Delete this lesson?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 hover:text-red-900">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <p class="mt-6">
        <a href="{{ route('courses.show', $course) }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to course</a>
    </p>
@endsection
