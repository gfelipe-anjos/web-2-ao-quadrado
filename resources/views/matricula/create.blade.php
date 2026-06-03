@extends('template/main',
[
    'titulo' => 'Sistema Aula',
    'cabecalho' => 'Nova Matrícula',
    'rota' => '',
])

@section('conteudo')
<form action="{{ route('matricula.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <select
                    name="aluno_id"
                    class="form-select @error('aluno_id') is-invalid @enderror"
                >
                    <option value="">Selecione um aluno</option>

                    @foreach($alunos as $aluno)
                        <option
                            value="{{ $aluno->id }}"
                            {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}
                        >
                            {{ $aluno->nome }}
                        </option>
                    @endforeach
                </select>

                <label>Aluno</label>

                @error('aluno_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <select
                    name="disciplina_id"
                    class="form-select @error('disciplina_id') is-invalid @enderror"
                >
                    <option value="">Selecione uma disciplina</option>

                    @foreach($disciplinas as $disciplina)
                        <option
                            value="{{ $disciplina->id }}"
                            {{ old('disciplina_id') == $disciplina->id ? 'selected' : '' }}
                        >
                            {{ $disciplina->nome }}
                        </option>
                    @endforeach
                </select>

                <label>Disciplina</label>

                @error('disciplina_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <a href="{{ route('matricula.index') }}"
               class="btn btn-secondary">
                Voltar
            </a>

            <button type="submit" class="btn btn-success">
                Confirmar
            </button>
        </div>
    </div>
</form>
@endsection