<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'isbn', 'ano_publicacao',
        'quantidade_total', 'quantidade_disponivel',
        'autor_id', 'categoria_id',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function getDisponivelAttribute(): bool
    {
        return $this->quantidade_disponivel > 0;
    }
}
