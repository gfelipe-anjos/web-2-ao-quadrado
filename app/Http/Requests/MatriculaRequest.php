<?php

namespace App\Http\Requests;

use App\Models\Matricula;
use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'required' => 'O preenchimento deste campo é obrigatório!',
        ];
    }

    public function rules(): array
    {
        return [
            'aluno_id' => ['required','exists:alunos,id',
             function ($attribute, $value, $fail) {

                    $query = Matricula::where('aluno_id', $value)
                        ->where('disciplina_id', $this->disciplina_id);

                    if ($this->route('matricula')) {
                        $query->where('id', '!=', $this->route('matricula')->id);
                    }

                    if ($query->exists()) {
                        $fail('Este aluno já está matriculado nesta disciplina.');
                    }
                }
            ],

            'disciplina_id' => 'required|exists:disciplinas,id',
        ];
    }
}