<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WELCOME - TO LEARN MORE</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background: #f8fafc;
            }
            .nav {
                text-align: right;
                margin-bottom: 20px;
            }
            .nav a {
                margin-left: 12px;
                color: #007bff;
                text-decoration: none;
            }
            .nav a:hover {
                text-decoration: underline;
            }
            .main-heading {
                color: #007bff;
                text-align: center;
                margin-top: 20px;
            }
            .cta {
                text-align: center;
                margin: 24px 0;
            }
            .cta a {
                display: inline-block;
                background: #007bff;
                color: #fff;
                padding: 12px 24px;
                border-radius: 4px;
                text-decoration: none;
                margin: 0 8px;
            }
            .cta a.secondary {
                background: #fff;
                color: #007bff;
                border: 1px solid #007bff;
            }
            .courses-box {
                max-width: 700px;
                margin: 0 auto 30px;
                background: #fff;
                border: 1px solid #e2e8f0;
                padding: 16px;
                border-radius: 8px;
            }
            .courses-box ul {
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="nav">
            <a href="{{ route('blaze') }}">Home</a>
            <a href="{{ route('login') }}">Log in</a>
        </div>

        <div style="text-align: center;">
            <h1 class="main-heading">WELCOME - TO LEARN MORE</h1>

            <img src="{{ asset('images/picha.jpg') }}" alt="E-learning" style="max-width: 100%; height: auto;">
        </div>


        <div class="cta">
            <a href="{{ route('login') }}" class="secondary">Already have an account?</a>
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
                    <article class="flex flex-col border border-slate-200 bg-white p-5 shadow-sm">
                        <h3 class="font-semibold text-slate-900">{{ $course->title }}</h3>
                        <p class="mt-2 flex-1 text-sm text-slate-600 line-clamp-3">
                            {{ $course->description ?: 'No description provided.' }}
                        </p>
                        <div class="mt-4 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-900">{{ number_format((float) $course->price, 2) }}</span>
                            @auth
                                <a href="{{ route('courses.show', $course) }}" class="text-slate-600 hover:text-slate-900 hover:underline">
                                    View course
                                </a>
                            @else
                                <span class="text-slate-400">Log in to enroll</span>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
