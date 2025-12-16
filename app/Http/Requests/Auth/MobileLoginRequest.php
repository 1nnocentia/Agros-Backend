<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MobileLoginRequest extends FormRequest
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
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+62|62|0)8[0-9]{7,12}$/'
            ],
            // 'firebase_token' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.regex' => 'Format nomor telepon tidak valid. Gunakan format 08xxxxxxxxx atau 628xxxxxxxxx.',
        ];
    }

    public function getFormattedPhoneNumber(): string
    {
        $phoneNumber = $this->input('phone_number');
        
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } 
        elseif (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = $phoneNumber;
        }

        return $phoneNumber;
    }
}
