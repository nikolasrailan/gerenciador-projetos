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
        'admin_id', // ID do admin responsável
        'cliente_id', // ID do cliente vinculado
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
}