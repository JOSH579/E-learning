@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ $course->title }}</h1>
            <p class="mt-1 text-sm text-slate-600">
                Instructor: {{ $course->instructor?->name }}
                · {{ number_format((float) $course->price, 2) }}
                · <span class="capitalize">{{ $course->status->value }}</span>
            </p>
        </div>

        <div class="flex gap-3 text-sm">
            @can('update', $course)
                <a href="{{ route('courses.edit', $course) }}" class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                    Edit
                </a>
            @endcan
            @can('delete', $course)
                <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')">
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
        <h2 class="mb-2 text-sm font-medium text-slate-500">Description</h2>
        <p class="whitespace-pre-wrap text-slate-800">
            {{ $course->description ?: 'No description provided.' }}
        </p>
    </div>

    <p class="mt-6">
        <a href="{{ route('courses.index') }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to courses</a>
    </p>
@endsection
