<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Http\Requests\AlunoRequest;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Aluno::with(['curso', 'disciplina'])->orderBy('nome')->get();
        return view('aluno.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curso::orderBy('nome')->get();
        return view('aluno.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlunoRequest $request)
    {
        $validado = $request->validated();
        Aluno::create($validado);
        return redirect()->route('aluno.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aluno = Aluno::find($id);

        if(isset($aluno)) {
            return view('aluno.show', compact(['aluno']));
        }

        return "<h1>Aluno não encontrado!</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aluno = Aluno::find($id);
        $cursos = Curso::orderBy('nome')->get();

    
        if(isset($aluno)) {
            return view('aluno.edit', compact('aluno', 'cursos'));
        }

        return "<h1>Aluno não encontrado!</h1>";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlunoRequest $request, string $id)
    {
        $aluno = Aluno::find($id);

        if(isset($aluno)) {
            $validado = $request->validated();
            $aluno->update($validado);
            return redirect()->route('aluno.index');
        }

        return "<h1>Aluno não encontrado!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aluno = Aluno::find($id);

        if(isset($aluno)) {
            $aluno->delete();
            return redirect()->route('aluno.index');
        }

        return "<h1>Aluno não encontrado!</h1>";
    }
}
