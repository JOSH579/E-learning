<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Lesson $lesson): bool
    {
        return $user->can('view', $lesson->module->course);
    }

    public function create(User $user, Module $module): bool
    {
        return $user->can('update', $module->course);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->can('update', $lesson->module->course);
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->can('update', $lesson->module->course);
    }
}
