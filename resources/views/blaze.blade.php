@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<style>
        .card-container {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1100px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            width: 300px;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background-color: #e0e7ff;
            color: #4f46e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .card h3 {
            color: #1e293b;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.12);
            border-color: #4f46e5;
        }

        .card:hover .card-icon {
            background-color: #4f46e5;
            color: #ffffff;
        }


    </style>
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
                Trending courses
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
<div class="flex flex-wrap gap-6 sm:flex-cols-3lg:grid-cols-4 justify-items-center">

    @foreach ($publishedCourses as $course)

        <article class="group relative flex w-56 flex-col rounded-xl border-2 border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-4 hover:border-indigo-600 hover:shadow-2x4 hover:ring-4 hover:ring-indigo-200 cursor-pointer">

            <h3 class="font-semibold text-slate-900 transition-colors duration-200 group-hover:text-indigo-600 text-lg">
                {{ $course->title }}
            </h3>

            <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                {{ $course->description ?: 'No description provided.' }}
            </p>

            <div class="mt-6 flex items-center justify-between gap-3 border-t border-slate-100 pt-4 text-sm">

                <div class="flex flex-col">
                    <span class="text-xs font-medium text-slate-800">price</span>

                    <span class="text-base font-bold text-slate-900">
                        TZS {{ number_format((float) $course->price, 3) }}
                    </span>
                </div>

                @auth
                    <a href="{{ route('courses.show', $course) }}"
                       class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-700 hover:shadow group-hover:scale-105">
                        View course
                    </a>
                @else
                    <a href="{{ route('tranding') }}"
                       class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-3 py-2 text-xs font-medium text-slate-600 transition-colors duration-200 hover:bg-slate-200 hover:text-slate-900">
                        view _..
                    </a>
                @endauth

            </div>
        </article>

    @endforeach
    </div>

<section class="mb-6 mt-20">
        <div class="card-container">
            <div class="card">
                <div class="card-icon">🚀ENG</div>
               <!-- Njia ya 1: Kutumia slash / badala ya asset() -->
<img
    src=""C:\Users\Administrator\E-learning\public\images\(5).jpg
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

>
                <h3>be ENGINNEER</h3>
                <p>ENGINEERING: The engine of progress—turns theoretical concepts into real-world structures, bridges, and machinery..</p>
            </div>

            <div class="card">
                <div class="card-icon">💻IT</div>
                <img
    src="C:\Users\Administrator\E-learning\public\images\images (7).jpg"
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

>
                <h3>infomation techonology</h3>
                <p>IT: The backbone of the modern world—connects global systems, simplifies data access, and powers digital innovation.</p>
            </div>

            <div class="card">
                <div class="card-icon">CHEM</div>
                <img
    src=""C:\Users\Administrator\E-learning\public\images\images (3).jpg
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

>
                <h3>be chemistry</h3>
                <p>CHEMISTRY: The science of matter—explores chemical structures to innovate medicines, food production, and energy.</p>
            </div>
        </div>
<section class="mb-6 mt-20">
        <div class="card-container">
        <div class="card">
                <div class="card-icon">ARTS</div>
                <img
    src="public\images\images (6).jpg"
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

>
                <h3>ARTs for life</h3>
                <p>ARTS: The soul of society—preserves culture, fosters creativity, and sharpens critical thinking.</p>
            </div>

        <div class="card">
                <div class="card-icon">BIO</div>
                <img
    src="C:\Users\Administrator\E-learning\public\images\images (1).jpg"
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

>
                <h3>For living things</h3>
                <p>BIOLOGY: The science of life—helps us understand human health, cure diseases, and preserve the environment.</p>
            </div>


        <div class="card">
                <div class="card-icon">MATH</div>
                <img
    src="C:\Users\Administrator\E-learning\public\images\images.jpg"
    alt="You need it?"
    class="mx-auto mt-8 max-h-72 w-full max-w-3xl rounded-lg border border-slate-200 object-cover shadow-sm"

  >
                <h3>brain develop </h3>
                <p>MATHEMATICS: The language of the universe—builds logical reasoning, statistics, and complex problem-solving skills.</p>
            </div>

    </div>

    </section>

            </div>
        </div>

        
@endif

@endsection
