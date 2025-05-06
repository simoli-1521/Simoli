<?php

namespace App\Filament\Resources\BorrowResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBorrowRequest extends FormRequest
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
			'bukus_id' => 'required',
			'nama_peminjam' => 'required',
			'borrow_date' => 'required',
			'due_date' => 'required',
			'return_date' => 'required',
			'status' => 'required',
			'fine' => 'required|numeric',
			'condition' => 'required'
		];
    }
}
