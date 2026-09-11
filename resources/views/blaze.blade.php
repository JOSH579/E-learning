@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="mb-12 text-center">
        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Learn at your own pace</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
            Welcome to {{ config('app.name', 'E-learning') }}
        </h1>
        <p class="mx-auto mt-4 max-w-2xl text-slate-600">
            Browse published courses and register as a student to enroll and start learning.
        </p>

        <img
            src="{{ asset('images/picha.jpg') }}"
            alt="Students learning online"
            class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"
        >

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a
                href="{{ route('register') }}"
                class="bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800"
            >
                Register as a student
            </a>
            <a
                href="{{ route('login') }}"
                class="border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50"
            >
                Already have an account?
            </a>
            <a
                href="{{ route('tranding') }}"
                class="border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50"
            >
                TRENDING COURSES
            </a>
        </div>
    </section>

    @if ($publishedCourses->isNotEmpty())
        <section class="mb-12">
            <div class="mb-6 flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold tracking-tight">Published courses</h2>
                    <p class="mt-1 text-sm text-slate-600">Browse what is available on our platform.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($publishedCourses as $course)
                    <a
                        href="{{ route('courses.preview', $course) }}"
                        class="flex flex-col border border-slate-200 bg-white shadow-sm hover:border-slate-400"
                    >
                        <img
                            src="{{ $course->imageUrl() }}"
                            alt="{{ $course->title }}"
                            class="h-40 w-full object-cover"
                        >
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="font-semibold text-slate-900">{{ $course->title }}</h3>
                            <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                                {{ $course->description ?: 'No description provided.' }}
                            </p>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="font-medium">{{ number_format((float) $course->price, 2) }}</span>
                                <span class="text-slate-600">Preview →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection