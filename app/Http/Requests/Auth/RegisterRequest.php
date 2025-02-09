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
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email'
            ],
            'nim' => [
                'required',
                'unique:users,nim'
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
            'study_program_id' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama harus diisi',
            'email.required'    => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min'      => 'Password minimal 8 karakter',
            'password.confirmed'=> 'Password tidak sesuai',
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
