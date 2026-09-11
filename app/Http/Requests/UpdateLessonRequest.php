<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        $lesson = $this->route('lesson');

        return $this->user()?->can('update', $lesson) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'remove_notes' => ['sometimes', 'boolean'],
            'is_demo' => ['sometimes', 'boolean'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'position' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
            'video_url' => ['nullable', 'url', 'max:2048'], // 2MB max
        ];
    }
}
