@extends('layouts.app')

@section('content')

    <div class="content-box">
        <div class="head head-with-btns clearfix">
            <h4 class="content-title text-color pull-left">Contatos</h4>
            <div class="functions-btns pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="data-white">
                    <table id="table" class="display datatable">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Evento</th>
                            <th>Data do evento</th>
                            <th>FollowUP</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($contatos as $contato)
                                <tr>
                                    <td>{{ date( 'd/m/Y' , strtotime($contato->data))}}</td>
                                    <td>{{$contato->evento->cliente->nome}}</td>
                                    <td>@if(isset ($contato->evento->tipoEvento->nome)) {{$contato->evento->tipoEvento->nome}} @else Sem dado @endif</td>
                                    <td>{{ date( 'd/m/Y' , strtotime($contato->evento->dtevento))}}</td>
                                    <td>{{$contato->followup}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('contatos.edit', $contato->id)}}">
                                                <span style="padding: 5px" class="btn btn-success raised icon"><i class="zmdi zmdi-edit"></i> </span>
                                            </a>
                                            <a href="{{route('contatos.show', $contato->id)}}">
                                                <span style="padding: 5px" class="btn btn-danger raised icon"><i class="zmdi zmdi-delete"></i> </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr> <td style="text-align: center;" colspan="6"> Nada a mostrar!!! </td></tr>
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