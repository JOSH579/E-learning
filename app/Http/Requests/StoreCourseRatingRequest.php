<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $course = $this->route('course');

        return $this->user()?->canRateCourse($course) ?? false;
    }

    public function rules(): array
    {
        return [
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }
}