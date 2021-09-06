<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KamarStoreRequest extends FormRequest
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
        $no_kamar = $this->request->all()['no_kamar'];
        $id_kost = $this->request->all()['id_kost'];
        return [
            'id_kost' => ['required', 'integer'],
            'no_kamar' => ['required', 'string', 'max:10', 
                Rule::unique('kamar')->where(function ($query) use($no_kamar, $id_kost) {
                    return $query->where('no_kamar', $no_kamar)->where('id_kost', $id_kost);
                }),
            ],
            'harga' => ['required', 'integer'],
        ];
    }
}
