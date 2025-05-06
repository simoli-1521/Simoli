<?php

namespace App\Filament\Resources\PopularitasResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePopularitasRequest extends FormRequest
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
			'judul' => 'required',
			'penulis' => 'required',
			'kode_buku' => 'required',
			'sampul_buku' => 'required',
			'penerbit' => 'required',
			'jumlah_pinjam' => 'required',
			'tahun_terbit' => 'required',
			'stok' => 'required',
			'harga_buku' => 'required|numeric',
			'request_id' => 'required'
		];
    }
}
