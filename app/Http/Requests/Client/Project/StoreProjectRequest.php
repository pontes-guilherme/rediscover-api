<?php

namespace App\Http\Requests\Client\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'repository_url' => ['required', 'string', 'max:255'],
            'abandonment_reason' => ['required', 'string'],
            'project_future' => ['required', 'string'],
            'project_abandonment_status' => ['required', 'string'],

            'tags' => ['required', 'array'],
            'tags.*.id' => ['required', 'int', 'exists:tags,id'],

            'technologies' => ['required', 'array'],
            'technologies.*.id' => ['required', 'int', 'exists:technologies,id'],
        ];
    }
}
