{{-- View principal dos Telefones --}}
@extends('layouts.app')

@section('content')
    <script>
        function confirmaDelete() {
            //rever essa parte, talvez não liberar para deletar -> json
            return confirm("Certeza de apagar esse registro?");
        }
    </script>
    <div class="card">
        <div class="card-header h4">Diviões da PRIP
            <button type="button" class="btn btn-secundary float-right">
                <!-- rota antiga: route('nip.exportacao') -->
                <a href="#" target="_blank">
                    <i class="fa fa-file-pdf" aria-hidden="true" title="Lista PDF"></i></button></a>
        </div>

        <div class="card-body">
            <table class="table table-striped  btn-spinner datatable-simples dt-paging-50 dt-buttons dt-fixed-header">
                <thead>
                    <tr>
                        @can('manager') <th>ID</th> @endcan
                        <th>ID</th>
                        <th>Sigla</th>
                        <th>Descrição</th>
                        @can('manager') <th>AÇÃO</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    {{-- resource/views/divisas/index.blade.php --}}
                    @csrf
                    @foreach ($divisas as $divisa)
                        <tr>
                           <td>{{$divisa['id']}}</td>
                            <td>{{ $divisa['sigla'] }}</td>
                            <td>{{ $divisa['descricao'] }}</td>
                            @can('manager')
                            <td>
                                <a href="{{ route('divisa.edit', $divisa['id']) }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

