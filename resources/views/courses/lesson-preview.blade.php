@extends('layouts.app')

@section('title', $lesson->title.' — Demo')

@section('content')
    <p class="mb-4 text-sm text-slate-500">
        <a href="{{ route('blaze') }}" class="hover:text-slate-900">Home</a>
        ·
        <a href="{{ route('courses.preview', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        · Demo lesson
    </p>

    <div class="mb-6 border border-emerald-200 bg-emerald-50 px-4 py-4 sm:px-5">
        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-800">Free demo</p>
        <p class="mt-1 text-sm text-emerald-900">
            This is a free preview lesson. Register and enroll to unlock the full course.
        </p>
    </div>

    <div class="mb-8 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">{{ $lesson->title }}</h1>
            @if ($lesson->module)
                <p class="mt-2 text-sm text-slate-600">
                    Module: {{ $lesson->module->title }}
                    · Lesson {{ $lesson->position }}
                </p>
            @endif
        </div>

        <div class="hidden flex-wrap gap-3 text-sm sm:flex">
            @guest
                <a
                    href="{{ route('register') }}"
                    class="bg-slate-900 px-4 py-2.5 font-medium text-white hover:bg-slate-800"
                >
                    Register for full access
                </a>
                <a
                    href="{{ route('login') }}"
                    class="border border-slate-300 bg-white px-4 py-2.5 font-medium text-slate-700 hover:bg-slate-50"
                >
                    Log in
                </a>
            @else
                @if (auth()->user()->isStudent())
                    <a
                        href="{{ route('courses.show', $course) }}"
                        class="bg-slate-900 px-4 py-2.5 font-medium text-white hover:bg-slate-800"
                    >
                        Go to full course
                    </a>
                @endif
            @endguest
        </div>
    </div>

    @if ($lesson->video_path)
        <section class="mb-8 overflow-hidden border border-slate-200 bg-black">
            <video
                controls
                class="aspect-video w-full"
                src="{{ $lesson->videoUrl() }}"
            >
                Your browser does not support the video tag.
            </video>
        </section>
    @endif

    @if ($lesson->content)
        <section class="mb-8 border border-slate-200 bg-white px-4 py-5 sm:px-6">
            <h2 class="text-sm font-medium text-slate-500">Lesson content</h2>
            <p class="mt-2 whitespace-pre-wrap text-slate-800">
                {{ $lesson->content }}
            </p>
        </section>
    @endif

    @if ($lesson->notes_path)
        <section class="mb-8 border border-slate-200 bg-white px-4 py-5 sm:px-6">
            <h2 class="text-sm font-medium text-slate-500">PDF notes</h2>
            <p class="mt-2 text-sm text-slate-600">Optional reading for this demo lesson.</p>
            <a
                href="{{ $lesson->notesUrl() }}"
                target="_blank"
                class="mt-3 inline-block text-sm font-medium text-slate-900 underline hover:no-underline"
            >
                Download / open PDF notes
            </a>
        </section>
    @endif

    @unless ($lesson->video_path || $lesson->content || $lesson->notes_path)
        <p class="mb-8 text-slate-600">No demo materials have been added to this lesson yet.</p>
    @endunless

    <section class="mb-24 border border-slate-200 bg-white px-4 py-6 text-center sm:mb-10 sm:px-6">
        <h2 class="text-lg font-semibold tracking-tight">Want the full course?</h2>
        <p class="mx-auto mt-2 max-w-lg text-sm text-slate-600">
            Go back to the course preview to see all modules, or register to enroll and unlock every lesson.
        </p>
        <div class="mt-5 flex flex-wrap items-center justify-center gap-3 text-sm">
            <a
                href="{{ route('courses.preview', $course) }}"
                class="border border-slate-300 bg-white px-4 py-2.5 font-medium text-slate-700 hover:bg-slate-50"
            >
                ← Back to course preview
            </a>
            @guest
                <a
                    href="{{ route('register') }}"
                    class="bg-slate-900 px-4 py-2.5 font-medium text-white hover:bg-slate-800"
                >
                    Register to enroll
                </a>
            @else
                @if (auth()->user()->isStudent())
                    <a
                        href="{{ route('courses.show', $course) }}"
                        class="bg-slate-900 px-4 py-2.5 font-medium text-white hover:bg-slate-800"
                    >
                        Open full course
                    </a>
                @endif
            @endguest
        </div>
    </section>

    @guest
        <div class="fixed inset-x-0 bottom-0 z-20 border-t border-slate-200 bg-white/95 px-4 py-3 backdrop-blur sm:hidden">
            <div class="mx-auto flex max-w-5xl gap-3">
                <a
                    href="{{ route('register') }}"
                    class="flex-1 bg-slate-900 px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-slate-800"
                >
                    Register for full access
                </a>
                <a
                    href="{{ route('courses.preview', $course) }}"
                    class="border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50"
                >
                    Preview
                </a>
            </div>
        </div>
    @endguest
@endsection