<?php

namespace App\Http\Controllers;

use App\Enums\CourseStatus;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Enums\CourseCategory;

class CourseController extends Controller
{
    /**
     * List courses (C of CRUD is create; this is Read — many).
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Course::class);

        $user = $request->user();

        $courses = Course::query()
            ->with('instructor')
            ->when(
                $user->isStudent(),
                fn ($query) => $query->where('status', CourseStatus::Published),
            )
            ->when(
                $user->canInstruct() && ! $user->isAdmin(),
                fn ($query) => $query->where('instructor_id', $user->id),
            )
            ->latest()
            ->paginate(10);

        $enrolledCourseIds = $user->isStudent()
            ? $user->enrollments()->pluck('course_id')
            : collect();

        return view('courses.index', compact('courses', 'enrolledCourseIds'));
    }

    /**
     * Show the form to create a course.
     */
    public function create(): View
    {
        $this->authorize('create', Course::class);

        return view('courses.create', [
            'statuses' => CourseStatus::cases(),
            'categories' => CourseCategory::cases(),
        ]);
    }

    /**
     * Store a new course (Create).
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $this->authorize('create', Course::class);

        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('courses', 'public');
        }

        $course = Course::create([
            ...$data,
            'instructor_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show one course (Read — one).
     */
    public function show(Request $request, Course $course): View
    {
        $this->authorize('view', $course);

        $course->load(['instructor', 'modules.lessons']);

        $isEnrolled = $request->user()->isEnrolledIn($course);

        $progress = null;

        if ($request->user()->isStudent() && $isEnrolled) {
            $lessonIds = $course->lessons()->pluck('lessons.id');

            $totalLessons = $lessonIds->count();
            $completedLessons = $request->user()
            ->lessonCompletions()
            ->whereIn('lesson_id', $lessonIds)
            ->count();

            $progress = [
                'total' => $totalLessons,
                'completed' => $completedLessons,
                'percent' => $totalLessons > 0
                    ? (int) round(($completedLessons / $totalLessons) * 100)
                    : 0,
            ];
        }

        $averageRating = $course->averageRating();
        $ratingsCount = $course->ratingsCount();
        $userRating = $request->user()
            ->courseRatings()
            ->where('course_id', $course->id)
            ->first();
        $canRate = $request->user()->canRateCourse($course);

        return view('courses.show', compact('course', 'isEnrolled', 'progress', 'averageRating', 'ratingsCount', 'userRating', 'canRate'));
    }

    /**
     * Show the form to edit a course.
     */
    public function edit(Course $course): View
    {
        $this->authorize('update', $course);

        return view('courses.edit', [
            'course' => $course,
            'statuses' => CourseStatus::cases(),
            'categories' => CourseCategory::cases(),
        ]);
    }

    /**
     * Update an existing course (Update).
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $this->authorize('update', $course);
    $data = $request->safe()->except('image');

    if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('courses', 'public');
    }

    $course->update($data);

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Delete a course (Delete).
     */
    public function destroy(Course $course): RedirectResponse
    {
        $this->authorize('delete', $course);

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
