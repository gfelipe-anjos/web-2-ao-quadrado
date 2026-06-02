<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\MatriculaController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/curso', CursoController::class);
Route::resource('/disciplina', DisciplinaController::class);
Route::resource('/aluno', AlunoController::class);
Route::resource('/matricula', MatriculaController::class);
