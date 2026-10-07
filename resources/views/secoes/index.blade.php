{{-- resources/views/secoes/index.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="card">

    <div class="card-header h4">
        Seções da PRIP
    </div>

    <div class="card-body">

        <table id="tabela-secoes" class="table table-striped btn-spinner datatable-simples dt-paging-50 dt-paging-bottom dt-buttons dt-fixed-header">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sigla</th>
                    <th>Descrição</th>

                    @can('manager')
                        <th>Ação</th>
                    @endcan
                </tr>
            </thead>

            <tbody>

                @foreach($secoesAgrupadas as $divisao => $grupo)

                    {{-- Cabeçalho da Divisão --}}
                    <tr class="table-secondary">

                        <td>
                            <i class="fa fa-folder-open text-warning"
                               aria-hidden="true"></i>
                        </td>

                        <td>
                            <strong>{{ $divisao }}</strong>
                        </td>

                        <td></td>

                        @can('manager')
                            <td></td>
                        @endcan

                    </tr>

                    {{-- Seções da divisão --}}
                    @foreach($grupo as $secao)

                        <tr>

                            <td>

                                {{-- @can('manager') --}}

                                    <a href="{{ route('secoes.edit', $secao['id']) }}">
                                        {{ $secao['id'] }}
                                    </a>

                               {{-- @else

                                    {{ $secao['id'] }}

                                {{-- @endcan --}}

                            </td>

                            <td>{{ $secao['sigla'] }}</td>

                            <td>{{ $secao['descricao'] }}</td>

                            @can('manager')
                                <td>
                                    <a href="{{ route('secoes.edit', $secao['id']) }}"
                                       class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                </td>
                            @endcan

                        </tr>

                    @endforeach

                @endforeach

            </tbody>

        </table >

    </div>

</div>

@endsection

