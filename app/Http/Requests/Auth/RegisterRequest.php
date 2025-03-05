<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'unique:users,email',
                'ends_with:@students.um.ac.id'
            ],
            'password' => [
                'required',
                'min:8',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email harus diisi',
            'email.unique'      => 'Email sudah terdaftar',
            'email.ends_with'   => 'Harus menggunakan email UM',
            'password.required' => 'Password harus diisi',
            'password.min'      => 'Password minimal 8 karakter',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if (! $this->wantsJson()) {
            $errors = implode('<br>', $validator->errors()->all());
            alert()->html('Gagal',$errors,'error');
            $this->redirect = url("/auth/register");
        }
        parent::failedValidation($validator);
    }
}
