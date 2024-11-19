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
            'jogo_id' => 'required|numeric|gt:0',
            'placar_casa'=> [Rule::requiredIf(fn () => !$resultado), 'numeric', 'gte:0'],
            'placar_visitante'=> [Rule::requiredIf(fn () => !$resultado), 'numeric', 'gte:0'],
            'resultado'=> 'nullable|string|in:C,V,E',
            'valor'=> 'required|numeric|gt:0'
        ];
    }
    public function messages(): array{
        return [
            'jogo_id.required' => 'Você deve informar o id do Jogo',
            'placar_casa.numeric' => 'O placar deve ser um número positivo',
            'placar_casa.gte' => 'O placar deve ser um número positivo',
            'placar_visitante.numeric' => 'O placar deve ser um número positivo',
            'placar_visitante.gte' => 'O placar deve ser um número positivo',
            'resultado.in' => 'Resultado só aceita valores "C", "V", ou "E"',
            'valor.gt' => 'Valor da aposta deve ser positivo',
            'valor.numeric' => 'Valor da aposta deve ser numérico'
        ];
    }
}
