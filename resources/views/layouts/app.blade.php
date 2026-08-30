<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('courses.index') }}" class="text-lg font-semibold tracking-tight">
                {{ config('app.name', 'E-learning') }}
            </a>

            <nav class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('courses.index') }}" class="text-slate-600 hover:text-slate-900">Courses</a>
                    @if (auth()->user()->isStudent())
                        <a href="{{ route('enrollments.index') }}" class="text-slate-600 hover:text-slate-900">My courses</a>
                    @endif
                    @if (auth()->user()->canInstruct())
                        <a href="{{ route('courses.create') }}" class="text-slate-600 hover:text-slate-900">New course</a>
                    @endif
                    <span class="text-slate-500">{{ auth()->user()->name }} ({{ auth()->user()->role->value }})</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-600 hover:text-slate-900">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900">Log in</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8">
        @if (session('success'))
            <p class="mb-6 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </p>
        @endif

        @if ($errors->any())
            <div class="mb-6 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
