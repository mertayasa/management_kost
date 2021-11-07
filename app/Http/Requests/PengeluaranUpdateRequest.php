<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengeluaranUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($_REQUEST);
        return [
            'tgl_pengeluaran' => ['required', 'date'],
            'keterangan' => ['required', 'string'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:1000000000'],
            'id_kost' => ['exists:kost,id', 'gt:0'],
        ];
    }
}
