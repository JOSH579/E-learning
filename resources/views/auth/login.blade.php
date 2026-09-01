@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <h1 class="mb-6 text-2xl font-semibold tracking-tight">Log in</h1>

    <form method="POST" action="{{ route('login') }}" class="max-w-md space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-medium">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
            >
        </div>

        <div>
            <label for="password" class="mb-1 block text-sm font-medium">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
            >
        </div>

        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" name="remember" value="1">
            Remember me
        </label>

        <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Log in
        </button>
    </form>
@endsection
