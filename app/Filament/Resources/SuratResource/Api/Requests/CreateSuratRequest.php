<?php

namespace App\Filament\Resources\SuratResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSuratRequest extends FormRequest
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
			'pengajuan_id' => 'required',
			'jam_kerja_id' => 'required',
			'lokasi_id' => 'required',
			'nomor_surat' => 'required',
			'nama_kegiatan' => 'required',
			'nama_PJ' => 'required',
			'jabatan_PJ' => 'required',
			'ttd_PJ' => 'required',
			'narahubung' => 'required',
			'qr_validasi' => 'required'
		];
    }
}
