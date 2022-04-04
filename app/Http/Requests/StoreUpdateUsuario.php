<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUsuario extends FormRequest
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
        $id = $this->segment(2);
        return [
            'name' =>'required|min:3|max:255',
            'email' => "required|min:5|max:255|unique:users,email,{$id},id",
            'cpf' => "required|numeric|digits:11|unique:users,cpf,{$id},id"
        ];
    }
}
