<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'is_registration_open' => 'nullable|boolean',
            'is_proposal_submission_open' => 'nullable|boolean',
            'proposal_submission_year' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'is_registration_open.boolean' => 'Kolom ini harus berupa boolean',
            'is_proposal_submission_open.boolean' => 'Kolom ini harus berupa boolean',
            'proposal_submission_year.required' => 'Kolom ini harus diisi',
            'proposal_submission_year.integer' => 'Kolom ini harus berupa angka',
        ];
    }
}
