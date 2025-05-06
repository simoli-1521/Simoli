<?php

namespace App\Filament\Resources\PenilaianPegawaiResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenilaianPegawaiRequest extends FormRequest
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
			'pelapor_id' => 'required',
			'pegawai_id' => 'required',
			'penilaian' => 'required',
			'skor_penilaian' => 'required',
			'jenis_insiden' => 'required',
			'deskripsi' => 'required|string',
			'lokasi' => 'required',
			'anonim' => 'required',
			'foto_kejadian' => 'required'
		];
    }
}
