@extends('layouts.app')

@section('title', 'Create course')

@section('content')
    <h1 class="mb-6 text-2xl font-semibold tracking-tight">Create course</h1>

    <form method="POST" action="{{ route('courses.store') }}" class="max-w-xl space-y-4">
        @csrf
        @include('courses._form')

        <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Create course
        </button>
    </form>
@endsection
