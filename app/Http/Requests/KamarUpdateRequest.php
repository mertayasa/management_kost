<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KamarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $kamar = $this->route('kamar');
        return $kamar->kost->id == $this->kamar->id_kost;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $kamar = $this->route('kamar');
        $no_kamar = $this->request->all()['no_kamar'];
        return [
            'no_kamar' => ['required', 'string', 'max:10', 
                Rule::unique('kamar')->where(function ($query) use($no_kamar, $kamar) {
                    return ($query->where('id', '!=', $this->kamar->id)->where('no_kamar', $no_kamar)->where('id_kost', $kamar->kost->id)->get());
                }),
            ],
            'harga' => ['required', 'integer'],
        ];
    }
}
