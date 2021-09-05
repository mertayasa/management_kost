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
        return [
            'id_jenis_pengeluaran' => ['required', 'integer', 'gt:0'],
            'tgl_pengeluaran' => ['required', 'date'],
            'keterangan' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
        ];
    }
}
