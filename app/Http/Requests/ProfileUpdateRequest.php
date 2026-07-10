<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'username'    => ['required', 'string', 'max:255', Rule::unique('students')->ignore($this->user()->id)],
            'avatar'      => ['nullable', 'string', 'max:255'],
            'universitas' => ['nullable', 'string', 'max:150'],
            'angkatan'    => ['nullable', 'integer', 'min:2000', 'max:2099'],
        ];
    }
}
