@extends('layouts.app')

@section('title', 'Student Registration')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-semibold tracking-tight">Student registration</h1>
        <p class="mt-2 text-sm text-slate-600">
            Create your account to browse courses and enroll as a student.
        </p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. John Doe"
                    required
                    autofocus
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@gmail.com"
                    required
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="mb-1 block text-sm font-medium">Phone number</label>
                <input
                    id="phone"
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="+255 7XX XXX XXX"
                    required
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date_of_birth" class="mb-1 block text-sm font-medium">Date of birth</label>
                <input
                    id="date_of_birth"
                    type="date"
                    name="date_of_birth"
                    value="{{ old('date_of_birth') }}"
                    required
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
                @error('date_of_birth')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <fieldset>
                <legend class="mb-2 block text-sm font-medium">Gender</legend>
                <div class="flex gap-6 text-sm text-slate-700">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="gender" value="male" @checked(old('gender') === 'male') required>
                        Male
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="gender" value="female" @checked(old('gender') === 'female')>
                        Female
                    </label>
                </div>
                @error('gender')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </fieldset>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="At least 8 characters"
                    required
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirm password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                >
            </div>

            <button type="submit" class="w-full bg-slate-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-slate-800">
                Register now
            </button>
        </form>
        

        <p class="mt-6 text-center text-sm text-slate-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-slate-900 hover:underline">Log in</a>
        </p>
    </div>
@endsection
