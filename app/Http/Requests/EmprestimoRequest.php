<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isBibliotecario() ?? false;
    }

    public function rules(): array
    {
        return [
            'livro_id' => ['required', 'exists:livros,id'],
            'user_id' => ['required', 'exists:users,id'],
            'data_prevista_devolucao' => ['required', 'date', 'after:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'livro_id.required' => 'Selecione o livro a ser emprestado.',
            'user_id.required' => 'Selecione o leitor responsável pelo empréstimo.',
            'data_prevista_devolucao.after' => 'A data prevista de devolução deve ser futura.',
        ];
    }
}
