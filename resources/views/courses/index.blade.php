@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold tracking-tight">Courses</h1>

        @can('create', App\Models\Course::class)
            <a href="{{ route('courses.create') }}" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                New course
            </a>
        @endcan
    </div>

    @if ($courses->isEmpty())
        <p class="text-slate-600">No courses yet.</p>
    @else
        <div class="overflow-x-auto border border-slate-200 bg-white">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Instructor</th>
                        <th class="px-4 py-3 font-medium">Price</th>
                        <th class="px-4 py-3 font-medium">Status</th>
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
                            <td class="px-4 py-3">{{ number_format((float) $course->price, 2) }}</td>
                            <td class="px-4 py-3 capitalize">{{ $course->status->value }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('courses.show', $course) }}" class="text-slate-600 hover:text-slate-900">View</a>
                                    @can('update', $course)
                                        <a href="{{ route('courses.edit', $course) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                                    @endcan
                                    @can('delete', $course)
                                        <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-700 hover:text-red-900">Delete</button>
                                        </form>
                                    @endcan
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
