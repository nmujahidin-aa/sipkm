<?php

namespace App\Http\Requests\Lecturer;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'title' => ['required', 'string', 'max:250'],
            'comment' => ['nullable'],
            'feedback' => ['nullable', 'string', 'max:250'],
            'status' => ['nullable', 'boolean'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'proposal_id' => ['nullable', 'integer'],
            'reviewer_id' => ['nullable', 'integer'],
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
            'title.required' => 'Judul Catatan harus diisi',
            'title.max' => 'Maximal 250 karakter',
            'feedback.max' => 'Maximal 250 karakter',
            'file.mimes' => 'File harus berformat pdf',
            'file.max' => 'File maksimal 5MB',
        ];
    }
}
