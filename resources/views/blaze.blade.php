@extends('layouts.app')

@section('title', 'Welcome')

@section('hero')
    <section class="relative isolate overflow-hidden border-b border-slate-800 bg-slate-900 text-white">
        <img
            src="{{ asset('images/picha.jpg') }}"
            alt=""
            class="absolute inset-0 h-full w-full object-cover opacity-40"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/70 to-slate-900/40"></div>

        <div class="relative mx-auto flex min-h-[70vh] max-w-5xl flex-col justify-end px-4 pb-14 pt-24 sm:pb-16 sm:pt-28">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-200">
                {{ config('app.name', 'E-learning') }}
            </p>
            <h1 class="mt-3 max-w-2xl text-4xl font-semibold tracking-tight sm:text-5xl">
                Learn at your own pace
            </h1>
            <p class="mt-4 max-w-xl text-base text-slate-200 sm:text-lg">
                Browse published courses, try free demos, and register to enroll.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a
                    href="{{ route('register') }}"
                    class="bg-white px-5 py-2.5 text-sm font-medium text-slate-900 hover:bg-slate-100"
                >
                    Register as a student
                </a>
                <a
                    href="#courses"
                    class="border border-white/40 bg-white/10 px-5 py-2.5 text-sm font-medium text-white backdrop-blur hover:bg-white/20"
                >
                    Browse courses
                </a>
                <a
                    href="{{ route('tranding') }}"
                    class="border border-transparent px-5 py-2.5 text-sm font-medium text-slate-200 hover:text-white"
                >
                    Trending →
                </a>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @if ($publishedCourses->isNotEmpty())
        <section id="courses" class="mb-12 scroll-mt-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight">Published courses</h2>
                <p class="mt-1 text-sm text-slate-600">Preview any course — free demos need no account.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($publishedCourses as $course)
                    <a
                        href="{{ route('courses.preview', $course) }}"
                        class="group flex flex-col border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-slate-400 hover:shadow-md"
                    >
                        <img
                            src="{{ $course->imageUrl() }}"
                            alt="{{ $course->title }}"
                            class="h-40 w-full object-cover transition duration-200 group-hover:opacity-95"
                        >
                        <div class="flex flex-1 flex-col p-5">
                            <h3 class="font-semibold text-slate-900">{{ $course->title }}</h3>
                            @if ($course->category)
                                <p class="mt-1 text-xs uppercase tracking-wide text-slate-500">
                                    {{ $course->category->label() }}
                                </p>
                            @endif
                            <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                                {{ $course->description ?: 'No description provided.' }}
                            </p>
                            <div class="mt-4 flex items-center justify-between gap-2 text-sm">
                                @if ($course->ratings_count > 0)
                                    <span class="text-slate-600">
                                        ★ {{ number_format((float) $course->ratings_avg_score, 1) }}
                                        ({{ $course->ratings_count }})
                                    </span>
                                @else
                                    <span class="text-slate-400">No ratings yet</span>
                                @endif
                                <span class="font-medium">{{ number_format((float) $course->price, 2) }}</span>
                                <span class="text-slate-600 group-hover:text-slate-900">Preview →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @else
        <section id="courses" class="mb-12 scroll-mt-8 border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
            <h2 class="text-lg font-semibold tracking-tight">No published courses yet</h2>
            <p class="mt-2 text-sm text-slate-600">Check back soon, or register to get ready to enroll.</p>
            <a
                href="{{ route('register') }}"
                class="mt-6 inline-block bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800"
            >
                Register as a student
            </a>
        </section>
    @endif
@endsection