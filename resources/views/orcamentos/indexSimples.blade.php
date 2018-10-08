@extends('layouts.app')

@section('content')

    <div class="content-box">
        <div class="head head-with-btns clearfix">
            <h4 class="content-title text-color pull-left">{{$formtitle}}</h4>
            <div class="functions-btns pull-right">
                <a href="{{route('orcamentos.create')}}">
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
                            <th>Data do evento</th>
                            <th>Cliente</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Qtd de convidados</th>
                            <th>Data do ultimo contato</th>
                            <th>FollowUP</th>
                            <th style="width: 150px">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($orcamentos as $orcamento)
                                <tr>
                                    <td>{{ date( 'd/m/Y' , strtotime($orcamento->dtevento))}}</td>
                                    <td>{{$orcamento->cliente->nome}}</td>
                                    <td>{{$orcamento->cliente->telefone}}</td>
                                    <td>{{$orcamento->cliente->email}}</td>
                                    <td>@if(isset ($orcamento->qtdConvidado->nome)){{ $orcamento->qtdConvidado->nome }}@else Sem dado @endif</td>
                                    <td>@if(isset ($orcamento->ultimoContato->data)){{ date( 'd/m/Y' , strtotime($orcamento->ultimoContato->data)) }}@else Sem dado @endif</td>
                                    <td>@if(isset ($orcamento->ultimoContato->followup)){{ $orcamento->ultimoContato->followup }}@else Sem dado @endif</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('criaEvento', $orcamento->id)}}">
                                                <span style="padding: 5px" class="btn btn-success raised icon"><i class="zmdi zmdi-money"></i> </span>
                                            </a>
                                            <a href="{{route('criaContato', $orcamento->id)}}">
                                                <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-phone"></i> </span>
                                            </a>
                                            <a href="{{route('orcamentoResumo', $orcamento->id)}}">
                                                <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-edit"></i> </span>
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
    <script src="/vendor/bower_components/moment/moment-with-locales.min.js"></script>
    <script src="/vendor/bower_components/moment/sorting/datetime-moment.js"></script>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('D/M/YYYY');
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
        });

    </script>

@endsection