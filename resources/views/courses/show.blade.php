@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ $course->title }}</h1>
            <p class="mt-1 text-sm text-slate-600">
                Instructor: {{ $course->instructor?->name }}
                · {{ number_format((float) $course->price, 2) }}
                · <span class="capitalize">{{ $course->status->value }}</span>
                @if ($ratingsCount > 0)
                    · ★ {{ number_format((float) $averageRating, 1) }} ({{ $ratingsCount }})
                @endif
                @if (auth()->user()->isStudent() && $isEnrolled)
                    · <span class="text-emerald-700">Enrolled</span>
                @endif
            </p>
        </div>

        <div class="flex flex-wrap gap-3 text-sm">
            @can('create', [App\Models\Enrollment::class, $course])
                <form method="POST" action="{{ route('courses.enroll', $course) }}">
                    @csrf
                    <button type="submit" class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                        Enroll
                    </button>
                </form>
            @endcan

            @if (auth()->user()->isStudent() && $isEnrolled)
                <form method="POST" action="{{ route('courses.unenroll', $course) }}" onsubmit="return confirm('Leave this course?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-red-300 px-4 py-2 font-medium text-red-700 hover:bg-red-50">
                        Leave course
                    </button>
                </form>
            @endif

            @can('update', $course)
                <a href="{{ route('courses.edit', $course) }}" class="bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                    Edit
                </a>
            @endcan
            @can('delete', $course)
                <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border border-red-300 px-4 py-2 font-medium text-red-700 hover:bg-red-50">
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <div class="mb-8 border border-slate-200 bg-white px-4 py-5">
        <h2 class="mb-2 text-sm font-medium text-slate-500">Description</h2>
        <p class="whitespace-pre-wrap text-slate-800">
            {{ $course->description ?: 'No description provided.' }}
        </p>
    </div>
    @if (! is_null($progress ?? null))
        <p class="mb-6 text-sm text-slate-700">
            Progress:
            <span class="font-medium">{{ $progress['completed'] }} / {{ $progress['total'] }}</span>
            lessons
            ({{ $progress['percent'] }}%)
        </p>
    @endif

    <div class="mb-8 border border-slate-200 bg-white px-4 py-5">
        <h2 class="mb-2 text-sm font-medium text-slate-500">Ratings</h2>

        @if ($ratingsCount > 0)
            <p class="text-sm text-slate-800">
                Average:
                <span class="font-semibold">★ {{ number_format((float) $averageRating, 1) }}</span>
                ({{ $ratingsCount }} {{ $ratingsCount === 1 ? 'rating' : 'ratings' }})
            </p>
        @else
            <p class="text-sm text-slate-500">No ratings yet.</p>
        @endif

        @if ($canRate)
            <form method="POST" action="{{ route('courses.ratings.store', $course) }}" class="mt-4 max-w-md space-y-3">
                @csrf

                <div>
                    <label for="score" class="mb-1 block text-sm font-medium">Your score (1–5)</label>
                    <select
                        id="score"
                        name="score"
                        required
                        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                    >
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected(old('score', $userRating?->score) == $i)>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="comment" class="mb-1 block text-sm font-medium">Comment (optional)</label>
                    <textarea
                        id="comment"
                        name="comment"
                        rows="3"
                        class="w-full border border-slate-300 bg-white px-3 py-2 text-sm"
                    >{{ old('comment', $userRating?->comment) }}</textarea>
                </div>

                <button type="submit" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    {{ $userRating ? 'Update rating' : 'Submit rating' }}
                </button>
            </form>

            @if ($userRating)
                <form
                    method="POST"
                    action="{{ route('courses.ratings.destroy', $course) }}"
                    class="mt-3"
                    onsubmit="return confirm('Remove your rating?')"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-700 hover:text-red-900">
                        Remove my rating
                    </button>
                </form>
            @endif
        @elseif (auth()->user()->isStudent() && $isEnrolled)
            <p class="mt-3 text-sm text-slate-600">
                Reach at least 70% progress to rate this course.
                @if (! is_null($progress ?? null))
                    (You are at {{ $progress['percent'] }}%.)
                @endif
            </p>
        @endif
    </div>

    @if (auth()->user()->isStudent() && ! $isEnrolled)
        <p class="mb-6 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
            Enroll in this course to open modules and lessons.
        </p>
    @endif

    <div class="mb-4 flex items-center justify-between gap-4">
        <h2 class="text-lg font-semibold tracking-tight">Modules</h2>
        @can('update', $course)
            <a href="{{ route('courses.modules.create', $course) }}" class="bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                Add module
            </a>
        @endcan
    </div>

    @if ($course->modules->isEmpty())
        <p class="text-slate-600">No modules yet.</p>
    @else
        <div class="overflow-x-auto border border-slate-200 bg-white">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 font-medium">#</th>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Lessons</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->modules as $module)
                        <tr class="border-b border-slate-100">
                            <td class="px-4 py-3 text-slate-500">{{ $module->position }}</td>
                            <td class="px-4 py-3 font-medium">
                                @can('view', $module)
                                    <a href="{{ route('courses.modules.show', [$course, $module]) }}" class="hover:underline">
                                        {{ $module->title }}
                                    </a>
                                @else
                                    {{ $module->title }}
                                @endcan
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $module->lessons->count() }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-3">
                                    @can('view', $module)
                                        <a href="{{ route('courses.modules.show', [$course, $module]) }}" class="text-slate-600 hover:text-slate-900">View</a>
                                    @else
                                        <span class="text-slate-400">Enroll to open</span>
                                    @endcan
                                    @can('update', $module)
                                        <a href="{{ route('courses.modules.edit', [$course, $module]) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                                    @endcan
                                    @can('delete', $module)
                                        <form method="POST" action="{{ route('courses.modules.destroy', [$course, $module]) }}" onsubmit="return confirm('Delete this module and its lessons?')">
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
    @endif

    <p class="mt-6">
        <a href="{{ route('courses.index') }}" class="text-sm text-slate-600 hover:text-slate-900">← Back to courses</a>
    </p>
@endsection
