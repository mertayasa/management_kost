<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenyewaStoreRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string'],
            'nama' => ['required', 'string', 'max:50'],
            'no_ktp' => ['required', 'string', 'max:16'],
            'telpon' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
            'pekerjaan' => ['required', 'string'],
            'status_validasi' => ['required', 'integer'],
        ];
    }
}
