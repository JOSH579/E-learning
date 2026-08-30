<?php

namespace App\Policies;

use App\Enums\CourseStatus;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentPolicy
{
    /**
     * Students may enroll in published courses they are not already in.
     */
    public function create(User $user, Course $course): bool
    {
        if (! $user->isStudent()) {
            return false;
        }

        if ($course->status !== CourseStatus::Published) {
            return false;
        }

        return ! $user->isEnrolledIn($course);
    }

    /**
     * Students may leave courses they are enrolled in.
     */
    public function delete(User $user, Enrollment $enrollment): bool
    {
        return $user->isStudent() && $enrollment->user_id === $user->id;
    }
}
