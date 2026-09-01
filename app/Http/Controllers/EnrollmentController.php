<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    /**
     * List courses the current student is enrolled in.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        abort_unless($user->isStudent(), 403);

        $courses = $user->enrolledCourses()
            ->with('instructor')
            ->latest('enrollments.enrolled_at')
            ->paginate(10);

        return view('enrollments.index', compact('courses'));
    }

    /**
     * Enroll the current student in a published course.
     */
    public function store(Request $request, Course $course): RedirectResponse
    {
        $this->authorize('create', [Enrollment::class, $course]);

        Enrollment::create([
            'user_id' => $request->user()->id,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'You are now enrolled in this course.');
    }

    /**
     * Unenroll the current student from a course.
     */
    public function destroy(Request $request, Course $course): RedirectResponse
    {
        $enrollment = Enrollment::query()
            ->where('user_id', $request->user()->id)
            ->where('course_id', $course->id)
            ->firstOrFail();

        $this->authorize('delete', $enrollment);

        $enrollment->delete();

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'You have left this course.');
    }
}
