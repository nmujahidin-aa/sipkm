<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LecturerRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => ['required', 'unique:users,email,' . $this->id],
            'nidn' => ['nullable', 'unique:users,nidn,' . $this->id],
            'nip' => ['nullable', 'unique:users,nip,' . $this->id],
            'nuptk' => ['nullable', 'unique:users,nuptk,' . $this->id],
            'phone' => 'min:11|max:13|nullable',
            'study_program_id' => 'required|string',
            'bank_name' => 'nullable|string',
            'bank_number' => 'nullable|string',
            'password' => 'nullable|string',
            'faculty_id' => 'nullable|string',
            'roles' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email tidak valid',
            'nidn.unique' => 'NIDN sudah terdaftar',
            'nip.unique' => 'NIP sudah terdaftar',
            'nuptk.unique' => 'NUPTK sudah terdaftar',
            'phone.min' => 'Nomor telepon minimal 11 karakter',
            'phone.max' => 'Nomor telepon maksimal 13 karakter',
            'study_program_id.required' => 'Program studi harus diisi',
        ];
    }
}
