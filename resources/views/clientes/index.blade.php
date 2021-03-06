@extends('layouts.app')

@section('content')

            <div class="content-box">
                <div class="head head-with-btns clearfix">
                    <h4 class="content-title text-color pull-left">Clientes</h4>
                    <div class="functions-btns pull-right">
                        <a href="{{route('clientes.create')}}">
                            <span class="btn btn-info raised waves-effect"> <i class="zmdi zmdi-plus"></i>  Novo </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="data-white">
                            <table id="table" class="display datatable">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Data do primeiro contato</th>
                                    <th>Qtd de orçamentos</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clientes as $cliente)
                                    <tr>
                                        <td><a href="{{route('resumoCliente', $cliente->id)}}">{{$cliente->nome}} </a>
                                        </td>
                                        <td>{{$cliente->telefone}}</td>
                                        <td>{{ date( 'd/m/Y' , strtotime($cliente->primeiroContato))}}</td>
                                        <td>{{$cliente->eventos->count()}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{route('clientes.edit', $cliente->id)}}">
                                                    <span style="padding: 5px" class="btn btn-success raised icon"><i
                                                                class="zmdi zmdi-edit"></i> </span>
                                                </a>
                                                <a href="{{route('clientes.show', $cliente->id)}}">
                                                    <span style="padding: 5px" class="btn btn-danger raised icon"><i
                                                                class="zmdi zmdi-delete"></i> </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td style="text-align: center;" colspan="6"> Nada a mostrar!!!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('scriptshead')

    <link rel="stylesheet" href="/vendor/bower_components/datatables/media/css/jquery.dataTables.min.css">

@endsection

@section('scriptsfoot')

    <script src="/vendor/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/bower_components/datatables.net-responsive/js/dataTables.responsive.js"></script>
    <script src="/vendor/bower_components/moment/moment-with-locales.min.js"></script>
    <script src="/vendor/bower_components/moment/sorting/datetime-moment.js"></script>

    <script>
        //Data Tables
        $('#table').DataTable({
            "dom": '<"toolbar tool"><"clear-filter">frtip',
            info: true,
            paging: true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todas"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                "decimal": "",
                "emptyTable": "Sem dados para mostrar",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Loading...",
                "processing": "Processando...",
                "zeroRecords": "Sem dados com essa descrição",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próxima",
                    "first": "Primeira",
                    "last": "Ultima"
                },
            }

        });

        $('.dataTables_filter input').attr("placeholder", "Procurar");

    </script>

@endsection