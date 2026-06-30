<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isBibliotecario() ?? false;
    }

    public function rules(): array
    {
        $livroId = $this->route('livro')?->id;

        return [
            'titulo' => ['required', 'string', 'max:200'],
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('livros', 'isbn')->ignore($livroId)],
            'ano_publicacao' => ['nullable', 'digits:4', 'integer', 'min:1500', 'max:' . (date('Y') + 1)],
            'quantidade_total' => ['required', 'integer', 'min:1'],
            'autor_id' => ['required', 'exists:autores,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título do livro é obrigatório.',
            'isbn.unique' => 'Já existe um livro cadastrado com esse ISBN.',
            'autor_id.required' => 'Selecione o autor do livro.',
            'categoria_id.required' => 'Selecione a categoria do livro.',
            'quantidade_total.min' => 'A quantidade total deve ser de pelo menos 1 exemplar.',
        ];
    }
}
