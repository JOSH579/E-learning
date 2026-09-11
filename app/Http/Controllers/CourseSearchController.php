<?php

namespace App\Http\Controllers;

use App\Enums\CourseStatus;
use App\Enums\UserRole;
use App\Http\Requests\SearchCoursesRequest;
use App\Models\Course;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseSearchController extends Controller
{
    public function create(Request $request): View
    {
        abort_unless($request->user()?->role === UserRole::Student, 403);

        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('courses.search', compact('products'));
    }

    public function index(SearchCoursesRequest $request): View
    {
        $keyword = $request->validated('keyword');
        $category = $request->validated('category', 'all') ?? 'all';
        $user = $request->user();

        $courses = Course::query()
            ->with('instructor')
            ->where('status', CourseStatus::Published)
            ->when(
                filled($keyword),
                function ($query) use ($keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where('title', 'like', "%{$keyword}%")
                            ->orWhere('description', 'like', "%{$keyword}%");
                    });
                }
            )
            ->when(
                $category !== 'all',
                fn ($query) => $query->where('category', $category)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $enrolledCourseIds = $user->enrollments()->pluck('course_id');

        return view('courses.search-results', compact('courses', 'keyword', 'category', 'enrolledCourseIds'));
    }
}
