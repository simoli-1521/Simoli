<?php

namespace App\Filament\Resources\ReimburseResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReimburseRequest extends FormRequest
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
			'bbm_id' => 'required',
			'pengajuanreimburse_id' => 'required',
			'tgl_pengajuan' => 'required',
			'tgl_diterima' => 'required',
			'tgl_ditolak' => 'required',
			'status' => 'required',
			'biaya' => 'required',
			'jenis_reimburse' => 'required',
			'foto_bukti' => 'required'
		];
    }
}
