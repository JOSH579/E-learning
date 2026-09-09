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
                <h2 class="text-xl font-semibold tracking-tight text-slate-900">Published courses</h2>
                <p class="mt-1 text-sm text-slate-600">Browse what is available on our platform.</p>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($publishedCourses as $course)
                <article class="group relative flex flex-col rounded-xl border-2 border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-2 hover:border-indigo-600 hover:shadow-2xl hover:ring-4 hover:ring-indigo-100 cursor-pointer">

                    {{-- Kichwa cha Kozi - Kinabadilika rangi panya inapofika --}}
                    <h3 class="font-semibold text-slate-900 transition-colors duration-200 group-hover:text-indigo-600 text-lg">
                        {{ $course->title }}
                    </h3>

                    {{-- Maelezo --}}
                    <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                        {{ $course->description ?: 'No description provided.' }}
                    </p>

                    {{-- Sehemu ya Chini: Bei na Kitufe --}}
                    <div class="mt-6 flex items-center justify-between gap-3 border-t border-slate-100 pt-4 text-sm">

                        {{-- Sehemu ya Bei --}}
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-slate-400">Bei</span>
                            <span class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-200">
                                TZS {{ number_format((float) $course->price, 2) }}
                            </span>
                        </div>

                        {{-- Viungo / Vitufe --}}
                        @auth
                            <a href="{{ route('courses.show', $course) }}"
                               class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-700 hover:shadow group-hover:scale-105">
                                View course
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-3 py-2 text-xs font-medium text-slate-600 transition-colors duration-200 hover:bg-slate-200 hover:text-slate-900">
                                Log in to enroll
                            </a>
                        @endauth
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endif

@endsection
