<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagemBlob extends Model
{
    protected $fillable = [
        'nome',
        'imagem'
    ];
}