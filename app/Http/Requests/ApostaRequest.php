<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApostaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $resultado = $this->request->get('resultado', null);
        return [
            'jogo_id' => 'required|integer',
            'placar_casa'=> Rule::requiredIf(fn () => !$resultado),
            'placar_visitante'=> Rule::requiredIf(fn () => !$resultado),
            'resultado'=> 'nullable|string|in:C,V,E',
            'valor'=> 'required|numeric'
        ];
    }
}
