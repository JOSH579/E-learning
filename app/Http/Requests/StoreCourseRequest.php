<?php

namespace App\Http\Requests;

use App\Enums\CourseStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CourseCategory;
use App\Enums\ResourceType;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->canInstruct() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:2048'], // 2MB max
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::enum(CourseStatus::class)],
            'category' => ['nullable', Rule::enum(CourseCategory::class)],
            'resource_type' => ['required', Rule::enum(ResourceType::class)],
        ];
    }
}
