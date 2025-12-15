<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataPanenRequest extends FormRequest
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
            'data_tanam_id' => 'required|exists:data_tanam,id',
            'harvest_date'  => 'required|date',
            'yield_weight'  => 'required|numeric|min:0.1',
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
            'data_tanam_id.required' => 'Data tanam wajib dipilih.',
            'data_tanam_id.exists' => 'Data tanam yang dipilih tidak valid.',
            'harvest_date.required' => 'Tanggal panen wajib diisi.',
            'harvest_date.date' => 'Format tanggal panen tidak valid.',
            'yield_weight.required' => 'Berat hasil panen wajib diisi.',
            'yield_weight.numeric' => 'Berat hasil panen harus berupa angka.',
            'yield_weight.min' => 'Berat hasil panen minimal 0.1 kg.',
        ];
    }
}
