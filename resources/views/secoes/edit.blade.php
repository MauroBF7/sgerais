{{-- resources/views/secoes/edit.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header h4">
        Editar Seção
    </div>

    <div class="card-body">

        <form action="{{ route('secoes.update', $secao['id']) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- ID --}}
                <div class="col-md-2 mb-3">
                    <label class="form-label">
                        ID
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $secao['id'] }}"
                        readonly>
                </div>

                {{-- Divisão --}}
                <div class="col-md-5 mb-3">
                    <label class="form-label">
                        Divisão
                    </label>

                    <select
                        name="siglaDiv"
                        class="form-control">

                        @foreach($divisas as $divisa)

                            <option
                                value="{{ $divisa['sigla'] }}"
                                @selected($divisa['sigla'] == $secao['siglaDiv'])>

                                {{ $divisa['sigla'] }}
                                -
                                {{ $divisa['descricao'] }}

                            </option>

                        @endforeach

                    </select>
                </div>

            </div>

            <div class="row">

                {{-- Sigla --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Sigla
                    </label>

                    <input
                        type="text"
                        name="sigla"
                        class="form-control"
                        value="{{ old('sigla', $secao['sigla']) }}"
                        required>

                </div>

                {{-- Descrição --}}
                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Descrição
                    </label>

                    <input
                        type="text"
                        name="descricao"
                        class="form-control"
                        value="{{ old('descricao', $secao['descricao']) }}"
                        required>

                </div>

            </div>

            <hr>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fa fa-save"></i>
                Salvar

            </button>

            <a
                href="{{ route('secoes.index') }}"
                class="btn btn-secondary">

                <i class="fa fa-arrow-left"></i>
                Voltar

            </a>

        </form>

    </div>

</div>

@endsection
