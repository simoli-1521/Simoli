<?php

namespace App\Filament\Resources\KehadiranResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateKehadiranRequest extends FormRequest
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
			'penjadwalan_id' => 'required',
			'izin_id' => 'required',
			'lokasi_peta_latitude' => 'required|numeric',
			'lokasi_peta_longtitude' => 'required|numeric',
			'foto_kehadiran_awal' => 'required',
			'foto_kehadiran_akhir' => 'required',
			'waktu_mulai' => 'required',
			'waktu_selesai' => 'required',
			'waktu_mulai_status' => 'required',
			'waktu_selesai_status' => 'required'
		];
    }
}
