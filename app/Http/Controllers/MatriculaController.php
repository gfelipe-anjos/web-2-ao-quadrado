<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Http\Requests\MatriculaRequest;
use Illuminate\Support\Facades\Gate;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Matricula::class);
        $data = Matricula::with(['aluno', 'disciplina'])->orderBy('nome')->get();
        return view('matricula.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Matricula::class);
        $alunos = Aluno::orderBy('nome')->get();
        $disciplinas = Disciplina::orderBy('nome')->get();

        return view('matricula.create', compact('alunos','disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatriculaRequest $request)
    {
        Gate::authorize('create', Matricula::class);
        Matricula::create($request->validated());
        return redirect()->route('matricula.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('view', Matricula::class);
        $matricula = Matricula::with(['aluno.curso','disciplina' ])->findOrFail($id);

        return view('matricula.show',compact('matricula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('update', Matricula::class);
        $alunos = Aluno::orderBy('nome')->get();
        $disciplinas = Disciplina::orderBy('nome')->get();

        $matricula = Matricula::findOrFail($id);

        return view('matricula.edit', compact('matricula','alunos','disciplinas' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatriculaRequest $request, Matricula $matricula)
    {
        Gate::authorize('update', $matricula);
        $matricula->update($request->validated());

        return redirect()->route('matricula.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete', Matricula::class);
        $matricula = Matricula::find($id);

        if(isset($matricula)) {
            $matricula->delete();
            return redirect()->route('matricula.index');
        }

        return "<h1>matricula$matricula não encontrada!</h1>";
    }
}
