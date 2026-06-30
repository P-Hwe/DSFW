<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        'livro_id', 'user_id', 'responsavel_id',
        'data_emprestimo', 'data_prevista_devolucao',
        'data_devolucao', 'status',
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_prevista_devolucao' => 'date',
        'data_devolucao' => 'date',
    ];

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class);
    }

    public function leitor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function estaAtrasado(): bool
    {
        return $this->status === 'emprestado'
            && $this->data_prevista_devolucao->isPast();
    }

    public function registrarDevolucao(): void
    {
        $this->update([
            'data_devolucao' => now(),
            'status' => 'devolvido',
        ]);

        $this->livro()->increment('quantidade_disponivel');
    }
}
