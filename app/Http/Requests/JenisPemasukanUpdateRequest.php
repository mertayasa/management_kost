<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisPemasukanUpdateRequest extends FormRequest
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
        $id_jenis = $this->route('jenis_pemasukan')->id;
        return [
            'jenis_pemasukan' => ['required', 'string', 'max:50', 'unique:jenis_pemasukan,jenis_pemasukan,'.$id_jenis],
        ];
    }
}
