@extends('layouts.app')

@section('title', 'Trending courses')

@section('content')
    <section class="mb-10">
        <p class="text-sm font-medium uppercase tracking-wider text-slate-500">Top picks</p>
        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
            Trending courses
        </h1>
        <p class="mt-3 max-w-2xl text-slate-600">
            Ranked by average rating, then number of reviews, then enrollments.
        </p>
        <p class="mt-4">
            <a href="{{ route('blaze') }}" class="text-sm text-slate-600 hover:text-slate-900">
                ← Back to home
            </a>
        </p>
    </section>

    <section class="mb-12">
        @if ($courses->isEmpty())
        <div class="border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
            <p class="text-sm font-medium text-slate-800">No published courses yet</p>
            <p class="mt-1 text-sm text-slate-500">Check back soon, or browse home when courses go live.</p>
            <a
                href="{{ route('blaze') }}"
                class="mt-5 inline-block text-sm font-medium text-slate-700 hover:text-slate-900"
            >
                ← Back to home
            </a>
        </div>   
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $course)
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
                            <h2 class="font-semibold text-slate-900">{{ $course->title }}</h2>
                            <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                                {{ $course->description ?: 'No description provided.' }}
                            </p>
                            <div class="mt-4 flex flex-wrap items-center justify-between gap-2 text-sm">
                                @if ($course->ratings_count > 0)
                                    <span class="text-slate-600">
                                        ★ {{ number_format((float) $course->ratings_avg_score, 1) }}
                                        ({{ $course->ratings_count }})
                                        · {{ $course->enrollments_count }} enrolled
                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        {{ $course->enrollments_count }} enrolled · No ratings yet
                                    </span>
                                @endif
                                <span class="text-slate-600 group-hover:text-slate-900">Preview →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <section class="mb-12 border-t border-slate-200 pt-10">
        <h2 class="text-xl font-semibold tracking-tight">Popular skills</h2>
        <p class="mt-1 text-sm text-slate-600">Skills students often look for on our platform.</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="border border-slate-200 bg-white p-5">
                <h3 class="font-semibold text-slate-900">Data Analysis & Management</h3>
                <p class="mt-2 text-sm text-slate-600">
                    SQL, Python, Excel, and visualization tools to support better decisions.
                </p>
            </div>
            <div class="border border-slate-200 bg-white p-5">
                <h3 class="font-semibold text-slate-900">Cloud Computing & DevOps</h3>
                <p class="mt-2 text-sm text-slate-600">
                    AWS, Azure, Docker, and Kubernetes for modern infrastructure.
                </p>
            </div>
            <div class="border border-slate-200 bg-white p-5">
                <h3 class="font-semibold text-slate-900">Software & Web Development</h3>
                <p class="mt-2 text-sm text-slate-600">
                    Building apps with JavaScript, Python, Laravel, and related stacks.
                </p>
            </div>
        </div>
    </section>
@endsection