<?php

namespace App\Http\Controllers;

use App\Enums\CourseStatus;
use App\Enums\UserRole;
use App\Http\Requests\SearchCoursesRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseSearchController extends Controller
{
    public function create(Request $request): View
    {
        abort_unless($request->user()?->role === UserRole::Student, 403);

        return view('courses.search');
    }

    public function index(SearchCoursesRequest $request): View
    {
        $keyword = $request->validated('keyword');
        $user = $request->user();

        $courses = Course::query()
            ->with('instructor')
            ->where('status', CourseStatus::Published)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $enrolledCourseIds = $user->enrollments()->pluck('course_id');

        return view('courses.search-results', compact('courses', 'keyword', 'enrolledCourseIds'));
    }
}
