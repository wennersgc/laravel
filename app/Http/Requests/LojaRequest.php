<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LojaRequest extends FormRequest
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
            'nome' => 'required|max:15|min:10',
            'descricao' => 'required|max:255',
            'fone' => 'required',
            'celular' => 'required',
            'logo' => 'image',
        ];
    }

    public function messages()
    {
        return[
            'min' => 'Campo :attribute deve ter no minimo :min caracteres',
            'max' => 'Campo :attribute deve ter no máximo :max caracteres',
            'required' => 'Campo :attribute obrigatório',
            'image' => 'Este arquivo não é uma imagem válida'
        ];
    }
}
