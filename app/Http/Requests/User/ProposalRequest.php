<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProposalRequest extends FormRequest
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
        $rules = [
            'title' => [
                'required',
                'string',
                Rule::unique('proposals', 'title')->ignore($this->id)
            ],
            'note' => ['nullable'],
            'leader_id' => ['required', 'exists:users,id'],
            'team_name' => ['required', 'string'],
            'advisors' => ['required', 'string'],
            'members' => ['required', 'array'],
            'members.*' => ['exists:users,id'],
            'scheme' => ['required', 'string'],
        ];

        if (!$this->has('id')) {
            $rules['file'] = ['required', 'file', 'mimes:pdf', 'max:5120'];
        } else {
            $rules['file'] = ['nullable', 'file', 'mimes:pdf', 'max:5120'];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi',
            'title.unique' => 'Judul sudah terdaftar',
            'scheme.required' => 'Skema wajib diisi',
            'leader_id.required' => 'Ketua wajib diisi',
            'team_name.required' => 'Nama tim wajib diisi',
            'file.required' => 'File proposal wajib diisi',
            'file.mimes' => 'File proposal harus berformat pdf',
            'file.max' => 'File proposal maksimal 5MB',
            'members.required' => 'Anggota wajib diisi',
            'members.*.required' => 'Anggota wajib diisi',
            'advisors.required' => 'Pembimbing wajib diisi',
        ];
    }
}
