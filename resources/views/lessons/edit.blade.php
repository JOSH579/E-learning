@extends('layouts.app')

@section('title', 'Edit lesson')

@section('content')
    <p class="mb-2 text-sm text-slate-500">
        <a href="{{ route('courses.show', $course) }}" class="hover:text-slate-900">{{ $course->title }}</a>
        ·
        <a href="{{ route('courses.modules.show', [$course, $module]) }}" class="hover:text-slate-900">{{ $module->title }}</a>
        · Edit lesson
    </p>

    <h1 class="mb-6 text-2xl font-semibold tracking-tight">Edit lesson</h1>

    <form method="POST" action="{{ route('courses.modules.lessons.update', [$course, $module, $lesson]) }}" class="max-w-xl space-y-4">
        @csrf
        @method('PUT')
        @include('lessons._form')

        <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Save changes
        </button>
    </form>
@endsection
