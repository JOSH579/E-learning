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
            class="h-56 w-full object-cover sm:h-72"
        >

        <div class="px-4 py-5 sm:px-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">{{ $course->title }}</h1>
                    <p class="mt-1 text-sm text-slate-600">
                        @if ($course->instructor)
                            Instructor: {{ $course->instructor->name }}
                            ·
                        @endif
                        <span class="font-medium text-slate-900">{{ number_format((float) $course->price, 2) }}</span>
                        @if ($course->category)
                            · {{ $course->category->label() }}
                        @endif
                        @if ($course->resource_type)
                            · {{ $course->resource_type->label() }}
                        @endif
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 text-sm">
                    @guest
                        <a
                            href="{{ route('register') }}"
                            class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800"
                        >
                            Register to enroll
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
                                Open course
                            </a>
                        @endif
                    @endguest
                </div>
            </div>

            <div class="mt-6">
                <h2 class="mb-2 text-sm font-medium text-slate-500">About this course</h2>
                <p class="whitespace-pre-wrap text-slate-800">
                    {{ $course->description ?: 'No description provided.' }}
                </p>
            </div>

            <p class="mt-4 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                Guests can open free demo lessons below. Register and enroll to unlock the full course.
            </p>
        </div>
    </div>

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
                                <li class="flex flex-wrap items-center justify-between gap-2 py-2 text-sm">
                                    <span class="text-slate-800">
                                        {{ $lesson->position }}. {{ $lesson->title }}
                                    </span>

                                    @if ($lesson->is_demo)
                                        <a
                                            href="{{ route('courses.lessons.preview', [$course, $lesson]) }}"
                                            class="font-medium text-emerald-700 hover:text-emerald-900 hover:underline"
                                        >
                                            Free demo →
                                        </a>
                                    @else
                                        <span class="text-slate-400">Enroll to unlock</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <p class="mt-8">
        <a href="{{ route('blaze') }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to home</a>
    </p>
@endsection
