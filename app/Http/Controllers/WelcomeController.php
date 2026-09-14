<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Enums\CourseStatus;
use App\Models\Course;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function blaze(): View
    {
        $publishedCourses = Course::query()
            ->where('status', CourseStatus::Published)
            ->withAvg('ratings', 'score')
            ->withCount('ratings')
            ->latest()
            ->get();

        return view('blaze', compact('publishedCourses'));
    }

    public function tranding(): View
    {
        $courses = Course::query()
            ->with('instructor')
            ->withAvg('ratings', 'score')
            ->withCount(['ratings', 'enrollments'])
            ->where('status', CourseStatus::Published)
            ->orderbyDesc(\Illuminate\Support\Facades\DB::raw('COALESCE(ratings_avg_score, 0)'))
            ->orderbyDesc('ratings_count')
            ->orderbyDesc('enrollments_count')
            ->take(6)
            ->get();

        return view('tranding', compact('courses'));
    }

    public function coursePreview(Course $course): View
    {
        abort_unless($course->status === CourseStatus::Published, 404);
    
        $course->load([
            'instructor',
            'modules.lessons',
            'ratings' => fn ($query) => $query->with('user')->latest(),
        ]);
        $course->loadAvg('ratings', 'score');
        $course->loadCount('ratings');
    
        return view('courses.preview', compact('course'));
    }

    public function lessonPreview(Course $course, Lesson $lesson): View
    {
        abort_unless($course->status === CourseStatus::Published, 404);
        abort_unless($lesson->module->course_id === $course->id, 404);
        abort_unless($lesson->is_demo, 403); //slice C adds is demo to lessons

        $lesson->load('module.course');

        $course->load(['instructor', 'modules.lessons']);
        return view('courses.lesson-preview', compact('course', 'lesson'));
    }
}
