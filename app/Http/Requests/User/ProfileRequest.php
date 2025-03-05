<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, 'um.ac.id')) {
                        $fail('Harus menggunakan email UM.');
                    }
                },
            ],
            'name' => [
                'required',
            ],
            'nim' => [
                'nullable',
            ],
            'nind' => [
                'nullable',
            ],
            'nip' => [
                'nullable',
            ],
            'nuptk' => [
                'nullable',
            ],
            'phone' => [
                'required',
            ],
            'study_program_id' => [
                'required',
            ],
            'bank_name' => [
                'nullable',
            ],
            'bank_number' => [
                'nullable',
            ],
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
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.ends_with' => 'Harus menggunakan email UM',
            'name.required' => 'Nama harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'study_program_id.required' => 'Program studi harus diisi',
        ];
    }
}
