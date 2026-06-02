<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Requests\CursoRequest;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Curso::with(['disciplina', 'aluno'])->orderBy('nome')->get();
        return view('curso.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CursoRequest $request)
    {
        $validado = $request->validated();
        Curso::create($validado);
        return redirect()->route('curso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::find($id);

        if(isset($curso)) {
            return view('curso.show', compact(['curso']));
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $curso = Curso::find($id);

        if(isset($curso)) {
            return view('curso.edit', compact(['curso']));
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CursoRequest $request, string $id)
    {
        $curso = Curso::find($id);

        if(isset($curso)) {
            $curso->update($request->validated());
            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::find($id);

        if(isset($curso)) {
            $curso->delete();
            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }
}
