<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'admin_id',
        'cliente_id',
    ];

    // Relacionamento com o usuário admin responsável
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relacionamento com o usuário cliente vinculado
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Relacionamento com Tarefas
    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}
