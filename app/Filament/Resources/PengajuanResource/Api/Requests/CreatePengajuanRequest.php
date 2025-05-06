<?php

namespace App\Filament\Resources\PengajuanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePengajuanRequest extends FormRequest
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
			'tgl_pengajuan' => 'required',
			'tgl_diterima_admin' => 'required',
			'tgl_ditolak_admin' => 'required',
			'tgl_diterima_sekdin' => 'required',
			'tgl_ditolak_sekdin' => 'required',
			'tgl_diterima_kadin' => 'required',
			'tgl_ditolak_kadin' => 'required',
			'keterangan_admin' => 'required',
			'keterangan_sekdin' => 'required',
			'keterangan_kadin' => 'required',
			'status_admin' => 'required',
			'status_sekdin' => 'required',
			'status_kadin' => 'required'
		];
    }
}
