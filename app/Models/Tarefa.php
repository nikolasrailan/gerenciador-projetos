<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'projeto_id',
        'admin_id',
    ];

    // Relacionamento com o Projeto
    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    // Relacionamento com o Admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
