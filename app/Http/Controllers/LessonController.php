<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function create(Course $course, Module $module): View
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('create', [Lesson::class, $module]);

        return view('lessons.create', [
            'course' => $course,
            'module' => $module,
            'nextPosition' => ($module->lessons()->max('position') ?? 0) + 1,
        ]);
    }

    public function store(StoreLessonRequest $request, Course $course, Module $module): RedirectResponse
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('create', [Lesson::class, $module]);

        $data = $request->validated();
        $data['position'] = $data['position']
            ?? (($module->lessons()->max('position') ?? 0) + 1);

        $lesson = $module->lessons()->create($data);

        return redirect()
            ->route('courses.modules.lessons.show', [$course, $module, $lesson])
            ->with('success', 'Lesson created successfully.');
    }

    public function show(Course $course, Module $module, Lesson $lesson): View
    {
        $this->ensureNesting($course, $module, $lesson);
        $this->authorize('view', $lesson);

        return view('lessons.show', compact('course', 'module', 'lesson'));
    }

    public function edit(Course $course, Module $module, Lesson $lesson): View
    {
        $this->ensureNesting($course, $module, $lesson);
        $this->authorize('update', $lesson);

        return view('lessons.edit', compact('course', 'module', 'lesson'));
    }

    public function update(
        UpdateLessonRequest $request,
        Course $course,
        Module $module,
        Lesson $lesson,
    ): RedirectResponse {
        $this->ensureNesting($course, $module, $lesson);
        $this->authorize('update', $lesson);

        $lesson->update($request->validated());

        return redirect()
            ->route('courses.modules.lessons.show', [$course, $module, $lesson])
            ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Course $course, Module $module, Lesson $lesson): RedirectResponse
    {
        $this->ensureNesting($course, $module, $lesson);
        $this->authorize('delete', $lesson);

        $lesson->delete();

        return redirect()
            ->route('courses.modules.show', [$course, $module])
            ->with('success', 'Lesson deleted successfully.');
    }

    private function ensureModuleBelongsToCourse(Course $course, Module $module): void
    {
        if ($module->course_id !== $course->id) {
            abort(404);
        }
    }

    private function ensureNesting(Course $course, Module $module, Lesson $lesson): void
    {
        $this->ensureModuleBelongsToCourse($course, $module);

        if ($lesson->module_id !== $module->id) {
            abort(404);
        }
    }
}
