<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JogoRequest extends BaseRequest
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
        return [
            'time_casa_id' => 'required',
            'time_visitante_id' => 'required|different:time_casa_id',
            'data_hora_jogo' => 'required|date',
            'modalidade_id' => 'required',
        ];
    }
}
