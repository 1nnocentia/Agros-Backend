<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataTanamRequest extends FormRequest
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
            'lahan_id'      => 'required|exists:lahan,id',
            'varietas_id'   => 'required|exists:varietas,id',
            'planting_date' => 'required|date',
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
            'lahan_id.required' => 'Lahan wajib dipilih.',
            'lahan_id.exists' => 'Lahan yang dipilih tidak valid.',
            'varietas_id.required' => 'Varietas wajib dipilih.',
            'varietas_id.exists' => 'Varietas yang dipilih tidak valid.',
            'planting_date.required' => 'Tanggal tanam wajib diisi.',
            'planting_date.date' => 'Format tanggal tanam tidak valid.',
        ];
    }
}
