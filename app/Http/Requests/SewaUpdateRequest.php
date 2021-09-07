<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SewaUpdateRequest extends FormRequest
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
            'id_kamar' => ['required', 'integer', 'gt:0'],
            'id_penyewa' => ['required', 'integer', 'gt:0'],
            'tgl_masuk' => ['required', 'date']
        ];
    }
}
