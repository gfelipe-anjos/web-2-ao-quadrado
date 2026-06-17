<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditablesTrait;

class Matricula extends Model implements Auditable
{
    use AuditablesTrait;

    protected $fillable = [
        'disciplina_id',
        'aluno_id',
    ];

    public function disciplina() {
        return $this->belongsTo('\App\Models\Disciplina');
    }

    public function aluno() {
        return $this->belongsTo('\App\Models\Aluno');
    }
}
