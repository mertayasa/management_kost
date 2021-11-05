<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KostUpdateRequest extends FormRequest
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
        $kost = $this->route('kost');
        return [
            'nama' => ['required', 'string', 'max:50', 'unique:kost,nama,'.$kost->id],
            'alamat' => ['required', 'string', 'max:100'],
            // 'jumlah_kamar' => ['required', 'integer', 'min:1'],
        ];
    }
}
