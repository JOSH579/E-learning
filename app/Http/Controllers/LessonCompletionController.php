<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LessonCompletionController extends Controller
{
    public function store(Request $request, Course $course, Module $module, Lesson $lesson): RedirectResponse
    {
        $this->ensureNesting($course, $module, $lesson);

        $user = $request->user();

        abort_unless($user->isStudent() && $user->isEnrolledIn($course), 403);

        LessonCompletion::query()->firstOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed_at' => now(),
            ],
        );

        return redirect()
            ->route('courses.modules.lessons.show', [$course, $module, $lesson])
            ->with('success', 'Lesson marked as complete.');
    }

    public function destroy(Request $request, Course $course, Module $module, Lesson $lesson): RedirectResponse
    {
        $this->ensureNesting($course, $module, $lesson);

        $user = $request->user();

        abort_unless($user->isStudent() && $user->isEnrolledIn($course), 403);

        LessonCompletion::query()
            ->where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->delete();

        return redirect()
            ->route('courses.modules.lessons.show', [$course, $module, $lesson])
            ->with('success', 'Lesson marked as incomplete.');
    }

    private function ensureNesting(Course $course, Module $module, Lesson $lesson): void
    {
        if ($module->course_id !== $course->id || $lesson->module_id !== $module->id) {
            abort(404);
        }
    }
}
