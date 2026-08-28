@extends('layouts.app')

@section('title', 'Add module')

@section('content')
    <p class="mb-2 text-sm text-slate-500">
        <a href="{{ route('courses.show', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        · New module
    </p>

    <h1 class="mb-6 text-2xl font-semibold tracking-tight">Add module</h1>

    <form method="POST" action="{{ route('courses.modules.store', $course) }}" class="max-w-xl space-y-4">
        @csrf
        @include('modules._form')

        <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Create module
        </button>
    </form>
@endsection
