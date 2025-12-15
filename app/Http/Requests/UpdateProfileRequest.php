<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name'  => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'kelompok_tani_id' => 'sometimes|nullable|exists:kelompok_tani,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',
            'phone_number.max' => 'Nomor telepon maksimal 20 karakter.',
            'kelompok_tani_id.exists' => 'Kelompok tani yang dipilih tidak valid.',
        ];
    }
}
