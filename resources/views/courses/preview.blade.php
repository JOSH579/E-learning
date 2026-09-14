@extends('layouts.app')

@section('title', $course->title.' — Preview')

@section('content')
    <p class="mb-4 text-sm text-slate-500">
        <a href="{{ route('blaze') }}" class="hover:text-slate-900">Home</a>
        · Course preview
    </p>

    <div class="mb-8 overflow-hidden border border-slate-200 bg-white">
        <img
            src="{{ $course->imageUrl() }}"
            alt="{{ $course->title }}"
            class="h-56 w-full object-cover sm:h-80"
        >

        <div class="px-4 py-6 sm:px-6">
            @if ($course->category)
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">
                    {{ $course->category->label() }}
                </p>
            @endif

            <div class="mt-2 flex flex-wrap items-start justify-between gap-4">
                <div class="min-w-0 flex-1">
                    <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                        {{ $course->title }}
                    </h1>

                    @if ($course->instructor)
                        <p class="mt-2 text-sm text-slate-600">
                            Instructor: {{ $course->instructor->name }}
                        </p>
                    @endif

                    <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm">
                        <span class="text-lg font-semibold text-slate-900">
                            {{ number_format((float) $course->price, 2) }}
                        </span>

                        @if ($course->ratings_count > 0)
                            <span class="text-slate-600">
                                ★ {{ number_format((float) $course->ratings_avg_score, 1) }}
                                ({{ $course->ratings_count }}
                                {{ $course->ratings_count === 1 ? 'rating' : 'ratings' }})
                            </span>
                        @else
                            <span class="text-slate-400">No ratings yet</span>
                        @endif
                    </div>
                </div>

                <div class="hidden flex-wrap gap-3 text-sm sm:flex">
                    @guest
                        <a
                            href="{{ route('register') }}"
                            class="bg-slate-900 px-4 py-2.5 font-medium text-white hover:bg-slate-800"
                        >
                            Register to enroll
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
                                Open course
                            </a>
                        @endif
                    @endguest
                </div>
            </div>

            <div class="mt-6 border-t border-slate-100 pt-6">
                <h2 class="text-sm font-medium text-slate-500">About this course</h2>
                <p class="mt-2 whitespace-pre-wrap text-slate-800">
                    {{ $course->description ?: 'No description provided.' }}
                </p>
            </div>

            <p class="mt-6 text-sm text-slate-600">
                Guests can open free demo lessons below. Register and enroll to unlock the full course.
            </p>
        </div>
    </div>

    <section class="mb-10">
        <h2 class="mb-4 text-lg font-semibold tracking-tight">Course content</h2>

        @if ($course->modules->isEmpty())
            <p class="text-slate-600">No modules yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($course->modules as $module)
                    <div class="border border-slate-200 bg-white px-4 py-4">
                        <h3 class="font-medium text-slate-900">
                            {{ $module->position }}. {{ $module->title }}
                        </h3>

                        @if ($module->lessons->isEmpty())
                            <p class="mt-2 text-sm text-slate-500">No lessons in this module.</p>
                        @else
                            <ul class="mt-3 divide-y divide-slate-100">
                                @foreach ($module->lessons as $lesson)
                                    <li class="flex flex-wrap items-center justify-between gap-3 py-3 text-sm">
                                        <span class="text-slate-800">
                                            {{ $lesson->position }}. {{ $lesson->title }}
                                        </span>

                                        @if ($lesson->is_demo)
                                            <a
                                                href="{{ route('courses.lessons.preview', [$course, $lesson]) }}"
                                                class="inline-flex items-center rounded-sm bg-emerald-50 px-2.5 py-1 text-xs font-semibold uppercase tracking-wide text-emerald-800 hover:bg-emerald-100"
                                            >
                                                Free demo
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium uppercase tracking-wide text-slate-400">
                                                Locked
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mb-10">
        <h2 class="mb-4 text-lg font-semibold tracking-tight">Student reviews</h2>

        @php
            $reviews = $course->ratings->filter(fn ($rating) => filled($rating->comment));
        @endphp

        @if ($reviews->isEmpty())
            <div class="border border-dashed border-slate-300 bg-white px-5 py-8 text-center">
                <p class="text-sm font-medium text-slate-800">No written reviews yet</p>
                <p class="mt-1 text-sm text-slate-500">
                    Be the first to review after enrolling and completing the course.
                </p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($reviews as $rating)
                    <div class="border border-slate-200 bg-white px-4 py-4">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <p class="text-sm font-medium text-slate-900">
                                {{ $rating->user?->name ?? 'Student' }}
                            </p>
                            <p class="text-sm text-slate-600">★ {{ $rating->score }}</p>
                        </div>
                        <p class="mt-2 whitespace-pre-wrap text-sm text-slate-700">
                            {{ $rating->comment }}
                        </p>
                        <p class="mt-2 text-xs text-slate-400">
                            {{ $rating->created_at?->format('M j, Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <p class="mb-24 sm:mb-8">
        <a href="{{ route('blaze') }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to home</a>
    </p>

    @guest
        <div class="fixed inset-x-0 bottom-0 z-20 border-t border-slate-200 bg-white/95 px-4 py-3 backdrop-blur sm:hidden">
            <div class="mx-auto flex max-w-5xl gap-3">
                <a
                    href="{{ route('register') }}"
                    class="flex-1 bg-slate-900 px-4 py-2.5 text-center text-sm font-medium text-white hover:bg-slate-800"
                >
                    Register to enroll
                </a>
                <a
                    href="{{ route('login') }}"
                    class="border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50"
                >
                    Log in
                </a>
            </div>
        </div>
    @endguest
@endsection