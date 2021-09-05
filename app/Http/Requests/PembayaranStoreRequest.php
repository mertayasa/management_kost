<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranStoreRequest extends FormRequest
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
            'id_jenis_pembayaran' => ['required', 'integer', 'gt:0'],
            'id_penyewa' => ['required', 'integer', 'gt:0'],
            'id_kamar' => ['required', 'integer', 'gt:0'],
            'jumlah' => ['required', 'integer'],
            'tgl_pembayaran' => ['required', 'date'],
        ];
    }
}
