<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditablesTrait;

class Disciplina extends Model implements Auditable
{
    use SoftDeletes;
    use AuditablesTrait;

    protected $fillable = [
        'nome',
        'carga_horaria',
        'curso_id',
    ];

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }

    public function aluno() {
        return $this->belongsToMany('\App\Models\Aluno', 'matriculas');
    }
}
