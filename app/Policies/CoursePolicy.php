<?php

namespace App\Policies;

use App\Enums\CourseStatus;
use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Anyone logged in can browse the course list.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Students may only view published courses.
     * Instructors may view their own; admins may view any.
     */
    public function view(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->canInstruct() && $course->instructor_id === $user->id) {
            return true;
        }

        return $user->isStudent() && $course->status === CourseStatus::Published;
    }

    /**
     * Only instructors and admins can create courses.
     */
    public function create(User $user): bool
    {
        return $user->canInstruct();
    }

    /**
     * Instructors may update their own courses; admins may update any.
     */
    public function update(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->canInstruct() && $course->instructor_id === $user->id;
    }

    /**
     * Instructors may delete their own courses; admins may delete any.
     */
    public function delete(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->canInstruct() && $course->instructor_id === $user->id;
    }
}
