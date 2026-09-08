@extends('layouts.app')

@section('title', 'Search results')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-tight">Search results</h1>
        <p class="mt-2 text-sm text-slate-600">
            Showing courses matching <span class="font-medium text-slate-900">"{{ $keyword }}"</span>
        </p>
    </div>

    @if ($courses->isEmpty())
        <p class="text-slate-600">No courses found for that keyword.</p>
    @else
        <div class="overflow-x-auto border border-slate-200 bg-white">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Instructor</th>
                        <th class="px-4 py-3 font-medium">Price</th>
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
                                @if ($enrolledCourseIds->contains($course->id))
                                    <span class="ml-2 text-xs text-emerald-700">Enrolled</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $course->instructor?->name }}</td>
                            <td class="px-4 py-3">{{ number_format((float) $course->price, 2) }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('courses.show', $course) }}" class="text-slate-600 hover:text-slate-900">View</a>
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

    <p class="mt-6">
        <a href="{{ route('courses.search') }}" class="text-sm text-slate-600 hover:text-slate-900 hover:underline">
            Back to search
        </a>
    </p>
@endsection
