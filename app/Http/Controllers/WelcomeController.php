<?php

namespace App\Http\Controllers;

use App\Enums\CourseStatus;
use App\Models\Course;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function blaze(): View
    {
        $publishedCourses = Course::query()
            ->where('status', CourseStatus::Published)
            ->latest()
            ->get();

        return view('blaze', compact('publishedCourses'));
    }

    public function tranding(): View
    {
        $courses = Course::query()
            ->with('instructor')
            ->where('status', CourseStatus::Published)
            ->latest()
            ->take(6)
            ->get();

        return view('tranding', compact('courses'));
    }

    public function coursePreview(Course $course): View
    {
        abort_unless($course->status === CourseStatus::Published, 404);

        $course->load('modules.lessons');
        $course->load(['instructor', 'modules.lessons']);
        return view('courses.preview', compact('course'));
    }
}
