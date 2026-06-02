<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'duracao',
    ];

    public function disciplina() {
        return $this->hasMany('\App\Models\Disciplina');
    }

    public function aluno() {
        return $this->hasMany('\App\Models\Aluno');
    }
}
