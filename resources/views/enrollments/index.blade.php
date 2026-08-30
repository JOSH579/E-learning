@extends('layouts.app')

@section('title', 'My courses')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold tracking-tight">My courses</h1>
        <a href="{{ route('courses.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Browse all courses</a>
    </div>

    @if ($courses->isEmpty())
        <p class="text-slate-600">You are not enrolled in any courses yet.</p>
        <p class="mt-4">
            <a href="{{ route('courses.index') }}" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Find a course
            </a>
        </p>
    @else
        <div class="overflow-x-auto border border-slate-200 bg-white">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Instructor</th>
                        <th class="px-4 py-3 font-medium">Enrolled</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="border-b border-slate-100">
                            <td class="px-4 py-3">
                                <a href="{{ route('courses.show', $course) }}" class="font-medium hover:underline">
                                    {{ $course->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $course->instructor?->name }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $course->pivot->enrolled_at
                                    ? \Illuminate\Support\Carbon::parse($course->pivot->enrolled_at)->format('Y-m-d')
                                    : '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('courses.show', $course) }}" class="text-slate-600 hover:text-slate-900">Open</a>
                                    <form method="POST" action="{{ route('courses.unenroll', $course) }}" onsubmit="return confirm('Leave this course?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-700 hover:text-red-900">Leave</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    @endif
@endsection
