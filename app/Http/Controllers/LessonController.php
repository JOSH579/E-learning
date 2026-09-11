<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
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

        $data = $request->safe()->except('notes');
        $data['position'] = $data['position']
            ?? (($module->lessons()->max('position') ?? 0) + 1);
        $data['is_demo'] = $request->boolean('is_demo');

        if ($request->hasFile('notes')) {
            $data['notes_path'] = $request->file('notes')->store('lessons', 'public');
        }

        $lesson = $module->lessons()->create($data);

        return redirect()
            ->route('courses.modules.lessons.show', [$course, $module, $lesson])
            ->with('success', 'Lesson created successfully.');
    }

    public function show(Request $request, Course $course, Module $module, Lesson $lesson): View
    {
        $this->ensureNesting($course, $module, $lesson);
        $this->authorize('view', $lesson);

        $isCompleted = $request->user()?->hasCompletedLesson($lesson);

        return view('lessons.show', compact('course', 'module', 'lesson', 'isCompleted'));
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
        
        $data = $request->safe()->except('notes');
        $data['is_demo'] = $request->boolean('is_demo');

        if ($request->hasFile('notes')) {
            $data['notes_path'] = $request->file('notes')->store('lessons', 'public');
        }

        $lesson->update($data);

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
