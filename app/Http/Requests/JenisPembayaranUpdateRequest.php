<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisPembayaranUpdateRequest extends FormRequest
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
        $id_jenis = $this->route('jenis_pembayaran')->id;
        return [
            'jenis_pembayaran' => ['required', 'string', 'max:50', 'unique:jenis_pembayaran,jenis_pembayaran,'.$id_jenis],
        ];
    }
}
