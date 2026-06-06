<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Curso;
use App\Http\Requests\DisciplinaRequest;
use Illuminate\Support\Facades\Gate;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Disciplina::class);
        $data = Disciplina::with(['curso'])->orderBy('nome')->get();
        return view('disciplina.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Disciplina::class);
        $cursos = Curso::all();
        return view('disciplina.create', compact(['cursos']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DisciplinaRequest $request)
    {
        Gate::authorize('create', Disciplina::class);
        Disciplina::create($request->validated());
        return redirect()->route('disciplina.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disciplina = Disciplina::find($id);
        Gate::authorize('view', $disciplina);

        if(isset($disciplina)) {
            return view('disciplina.show', compact(['disciplina']));
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $disciplina = Disciplina::find($id);
        Gate::authorize('update', $disciplina);
        $cursos = Curso::all();

        if(isset($disciplina)) {
            return view('disciplina.edit', compact(['disciplina', 'cursos']));
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DisciplinaRequest $request, string $id)
    {
            $disciplina = Disciplina::find($id);
            Gate::authorize('update', $disciplina);

            if(isset($disciplina)) {
                $disciplina->update($request->validated());
                return redirect()->route('disciplina.index');
            }

            return "<h1>Disciplina não encontrada!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disciplina = Disciplina::find($id);
        Gate::authorize('delete', $disciplina);

        if(isset($disciplina)) {
            $disciplina->delete();
            return redirect()->route('disciplina.index');
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }
}
