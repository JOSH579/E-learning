@extends('layouts.app')

@section('title', $lesson->title.' — Demo')

@section('content')
    <p class="mb-2 text-sm text-slate-500">
        <a href="{{ route('blaze') }}" class="hover:text-slate-900">Home</a>
        ·
        <a href="{{ route('courses.preview', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        · Demo lesson
    </p>

    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <p class="text-xs font-medium uppercase tracking-wider text-emerald-700">Free demo</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-tight">{{ $lesson->title }}</h1>
            @if ($lesson->module)
                <p class="mt-1 text-sm text-slate-600">
                    Module: {{ $lesson->module->title }}
                    · Lesson {{ $lesson->position }}
                </p>
            @endif
        </div>

        <div class="flex flex-wrap gap-3 text-sm">
            @guest
                <a
                    href="{{ route('register') }}"
                    class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800"
                >
                    Register for full access
                </a>
                <a
                    href="{{ route('login') }}"
                    class="border border-slate-300 bg-white px-4 py-2 font-medium text-slate-700 hover:bg-slate-50"
                >
                    Log in
                </a>
            @else
                @if (auth()->user()->isStudent())
                    <a
                        href="{{ route('courses.show', $course) }}"
                        class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800"
                    >
                        Go to full course
                    </a>
                @endif
            @endguest
        </div>
    </div>

    <p class="mb-6 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
        You are viewing a free demo lesson. Register and enroll to unlock the rest of this course.
    </p>

    <div class="border border-slate-200 bg-white px-4 py-5">
        <h2 class="mb-2 text-sm font-medium text-slate-500">Content</h2>
        <p class="whitespace-pre-wrap text-slate-800">
            {{ $lesson->content ?: 'No content yet.' }}
        </p>
    </div>

    <p class="mt-8">
        <a href="{{ route('courses.preview', $course) }}" class="text-sm text-slate-600 hover:text-slate-900">
            ← Back to course preview
        </a>
    </p>
@endsection
