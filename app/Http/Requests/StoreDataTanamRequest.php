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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // If lahan_name provided instead of lahan_id, find the lahan
        if ($this->has('lahan_name') && !$this->has('lahan_id')) {
            $lahan = \App\Models\Lahan::where('user_id', $this->user()->id)
                ->where('lahan_name', $this->lahan_name)
                ->first();
            
            if ($lahan) {
                $this->merge(['lahan_id' => $lahan->id]);
            }
        }
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
            'lahan_name'    => 'sometimes|string', // Optional, digunakan untuk lookup
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
            'lahan_id.required' => 'Lahan wajib dipilih (lahan_id atau lahan_name).',
            'lahan_id.exists' => 'Lahan yang dipilih tidak valid atau bukan milik Anda.',
            'lahan_name.string' => 'Nama lahan harus berupa teks.',
            'varietas_id.required' => 'Varietas wajib dipilih.',
            'varietas_id.exists' => 'Varietas yang dipilih tidak valid.',
            'planting_date.required' => 'Tanggal tanam wajib diisi.',
            'planting_date.date' => 'Format tanggal tanam tidak valid.',
        ];
    }
}
