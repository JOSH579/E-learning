<?php

namespace App\Http\Requests;
use App\Enums\UserRole;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchCoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === UserRole::Student;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'keyword' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', Rule::in('all',
             'computer_science',
            'it',
            'cyber_security',
            'language',
            'arts',
            'business',
            'social_sciences',
            'humanities',
            'engineering', 'math', 'physics', 'chemistry', 'biology', 'geology', 'astronomy')],
        ];
    }
}
