<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataPanenRequest extends FormRequest
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
            'harvest_date'  => 'sometimes|date',
            'yield_weight'  => 'sometimes|numeric|min:0.1',
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
            'harvest_date.date' => 'Format tanggal panen tidak valid.',
            'yield_weight.numeric' => 'Berat hasil panen harus berupa angka.',
            'yield_weight.min' => 'Berat hasil panen minimal 0.1 kg.',
        ];
    }
}
