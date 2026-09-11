<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRatingRequest;
use App\Models\Course;
use App\Models\CourseRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseRatingController extends Controller
{
    public function store(StoreCourseRatingRequest $request, Course $course): RedirectResponse
    {
        CourseRating::query()->updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'course_id' => $course->id,
            ],
            [
                'score' => $request->validated('score'),
                'comment' => $request->validated('comment'),
            ]
        );

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Thanks! Your rating was saved.');
    }

    public function destroy(Request $request, Course $course): RedirectResponse
    {
        abort_unless($request->user()?->canRateCourse($course), 403);

        CourseRating::query()
            ->where('user_id', $request->user()->id)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Your rating was removed.');
    }
}