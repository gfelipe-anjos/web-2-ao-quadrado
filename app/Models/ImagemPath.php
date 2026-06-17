<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemPath extends Model
{
    protected $table = 'imagem_paths';

    protected $fillable = [
        'nome',
        'caminho'
    ];
}