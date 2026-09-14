<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        $module = $this->route('module');

        return $this->user()?->can('update', $module->course) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'notes' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:102400'], // 100MB max
            'is_demo' => ['sometimes', 'boolean'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'position' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
