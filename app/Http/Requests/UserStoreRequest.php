<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'tempat_lahir' => ['required', 'string', 'max:50'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'string', 'max:16'],
            'telpon' => ['required', 'string', 'max:15'],
            'level' => ['required', 'numeric', 'min:1', 'max:2'],
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }
}
