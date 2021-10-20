<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

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
        // if(Request::is('*keluar*')){
        //     return [
        //         'tgl_keluar' => ['required', 'date']
        //     ];
        // }else{
            return [
                'tgl_masuk' => ['required', 'date'],
                'tgl_keluar' => ['nullable', 'date']
            ];
        // }
    }
}
