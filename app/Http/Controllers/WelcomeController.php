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
}
