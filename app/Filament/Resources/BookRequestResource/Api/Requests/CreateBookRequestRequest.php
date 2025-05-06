<?php

namespace App\Filament\Resources\BookRequestResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequestRequest extends FormRequest
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
			'user_id' => 'required',
			'judul' => 'required',
			'penulis' => 'required',
			'kode_buku' => 'required',
			'penerbit' => 'required',
			'tahun_terbit' => 'required',
			'alasan_permintaan' => 'required',
			'status' => 'required'
		];
    }
}
