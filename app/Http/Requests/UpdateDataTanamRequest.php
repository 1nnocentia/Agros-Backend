<?php

namespace App\Http\Requests;

use App\Models\StatusTanam;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDataTanamRequest extends FormRequest
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
            'lahan_id'      => 'sometimes|exists:lahan,id',
            'varietas_id'   => 'sometimes|exists:varietas,id',
            'planting_date' => 'sometimes|date',
            'status_tanam_id' => 'sometimes|in:' . implode(',', [
                StatusTanam::AKTIF,
                StatusTanam::PANEN,
                StatusTanam::GAGAL,
            ]),
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
            'lahan_id.exists' => 'Lahan yang dipilih tidak valid.',
            'varietas_id.exists' => 'Varietas yang dipilih tidak valid.',
            'planting_date.date' => 'Format tanggal tanam tidak valid.',
            'status_tanam_id.in' => 'Status tanam tidak valid.',
        ];
    }
}
