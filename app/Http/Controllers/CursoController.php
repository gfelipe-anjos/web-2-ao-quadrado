<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Requests\CursoRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\CursoService;

class CursoController extends Controller
{

public function __construct(protected CursoService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index() {
        Gate::authorize('viewAny', Curso::class);
        $data = $this->service->all(['disciplina', 'aluno'],  [], 'nome');
        return view('curso.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        Gate::authorize('create', Curso::class);
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CursoRequest $request)
    {
        Gate::authorize('create', Curso::class);
        $this->service->store($request->validated());
        return redirect()->route('curso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = $this->service->find($id);
        Gate::authorize('view', $curso);

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
        $curso = $this->service->find($id);
        Gate::authorize('update', $curso);

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
        $curso = $this->service->find($id);
        Gate::authorize('update', $curso);

        if(isset($curso)) {
            $this->service->update($request->validated(), $id);
            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = $this->service->find($id);
        Gate::authorize('delete', $curso);

        if(isset($curso)) {
            $this->service->remove($id);
            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }

     public function audit(string $id) {

        $curso = $this->service->find($id);
        Gate::authorize('delete',  $curso);
        $data = $this->service->audit($id);

        if(isset($data)) {
            // dd($data);
            return view('curso.audit', compact(['data']));
        }

        return "<h1>Não encontrado!</h1>";
    }
}
