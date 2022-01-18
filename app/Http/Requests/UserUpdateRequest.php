<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');
        $rules = [
            'nama' => ['required', 'string', 'max:50'],
            'tempat_lahir' => ['required', 'string', 'max:50'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'string', 'max:16'],
            'telpon' => ['required', 'string', 'max:13'],
        ];
        
        if($this->request->all()['password'] != null){
            $rules += ['password' => ['required', 'min:6', 'confirmed']];
        };

        return $rules;
    }
}
