<?php

namespace App\Filament\Resources\MobilResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMobilRequest extends FormRequest
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
			'nama' => 'required',
			'nopol' => 'required',
			'merk' => 'required',
			'tipe' => 'required',
			'thn_pembuatan' => 'required',
			'warna' => 'required'
		];
    }
}
