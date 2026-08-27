<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function create(Course $course): View
    {
        $this->authorize('create', [Module::class, $course]);

        return view('modules.create', [
            'course' => $course,
            'nextPosition' => ($course->modules()->max('position') ?? 0) + 1,
        ]);
    }

    public function store(StoreModuleRequest $request, Course $course): RedirectResponse
    {
        $this->authorize('create', [Module::class, $course]);

        $data = $request->validated();
        $data['position'] = $data['position']
            ?? (($course->modules()->max('position') ?? 0) + 1);

        $module = $course->modules()->create($data);

        return redirect()
            ->route('courses.modules.show', [$course, $module])
            ->with('success', 'Module created successfully.');
    }

    public function show(Course $course, Module $module): View
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('view', $module);

        $module->load('lessons');

        return view('modules.show', compact('course', 'module'));
    }

    public function edit(Course $course, Module $module): View
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('update', $module);

        return view('modules.edit', compact('course', 'module'));
    }

    public function update(UpdateModuleRequest $request, Course $course, Module $module): RedirectResponse
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('update', $module);

        $module->update($request->validated());

        return redirect()
            ->route('courses.modules.show', [$course, $module])
            ->with('success', 'Module updated successfully.');
    }

    public function destroy(Course $course, Module $module): RedirectResponse
    {
        $this->ensureModuleBelongsToCourse($course, $module);
        $this->authorize('delete', $module);

        $module->delete();

        return redirect()
            ->route('courses.show', $course)
            ->with('success', 'Module deleted successfully.');
    }

    private function ensureModuleBelongsToCourse(Course $course, Module $module): void
    {
        if ($module->course_id !== $course->id) {
            abort(404);
        }
    }
}
