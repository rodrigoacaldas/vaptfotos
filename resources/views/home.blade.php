@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h3 class="content-title" style="text-align: center">Resultados</h3>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-2 col-xs-3 col-md-offset-1">
                            <a href="{{route('orcamentoMensal', $meta->mes)}}">
                                <div class="color-container primary-bg">
                                    <span class="color">Orcamentos Abertos</span>
                                    <h2 style="color: #00bcd4">{{array_get($resultados, 'orcamentosAbertos')}}</h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Eventos Fechados</span>
                                <h2 style="color: #00bcd4">{{array_get($resultados, 'eventosFechados')}}</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Faturamento</span>
                                <h2 style="color: #00bcd4">@money(array_get($resultados, 'faturamento'))</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Entrada</span>
                                <h2 style="color: #00bcd4">@money(array_get($resultados, 'entrada'))</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Novos Clientes</span>
                                <h2 style="color: #00bcd4">{{array_get($resultados, 'novosClientes')}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="font-size: 14px; text-align: center">
                        <p>
                            <strong>Meta 1:</strong> @money($meta->meta1)
                            <strong>Meta 2:</strong> @money($meta->meta2)
                            <strong>Meta 3:</strong> @money($meta->meta3)
                            <strong>Meta 4:</strong> @money($meta->meta4)
                            <strong>Meta 5:</strong> @money($meta->meta5)
                        </p>
                    </div>
                </div>

            </div>

        </div>



    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="data-white">
                <table id="table2" class="display datatable">
                    <thead>
                    <tr>
                        <th style="width: 100px;">Data da criação</th>
                        <th style="width: 100px;">Data do evento</th>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ultimo contato</th>
                        <th>FollowUP</th>
                        <th style="width: 150px;">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orcamentos as $orcamento)
                        <tr>
                            <td>{{ date( 'd/m/Y' , strtotime($orcamento->created_at))}}</td>
                            <td>{{ date( 'd/m/Y' , strtotime($orcamento->dtevento))}}</td>
                            <td>{{$orcamento->cliente->nome}}</td>
                            <td>{{$orcamento->cliente->telefone}}</td>
                            <td>{{$orcamento->cliente->email}}</td>
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
                                    <a href="{{route('orcamentos.edit', $orcamento->id)}}">
                                        <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-edit"></i> </span>
                                    </a>
                                    <a href="{{route('orcamentos.show', $orcamento->id)}}">
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
    <div class="row">
        <div class="col-md-12">
            <div class="data-white">
                <table id="table" class="display datatable">
                    <thead>
                    <tr>
                        <th style="width: 100px;">Data da criação</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th style="width: 150px;">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ date( 'd/m/Y' , strtotime($cliente->created_at))}}</td>
                            <td>{{$cliente->nome}}</td>
                            <td>{{$cliente->telefone}}</td>
                            <td>{{$cliente->email}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('criaEvento', $cliente->id)}}">
                                        <span style="padding: 5px" class="btn btn-success raised icon"><i class="zmdi zmdi-money"></i> </span>
                                    </a>
                                    <a href="{{route('criaContato', $cliente->id)}}">
                                        <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-phone"></i> </span>
                                    </a>
                                    <a href="{{route('orcamentos.edit', $cliente->id)}}">
                                        <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-edit"></i> </span>
                                    </a>
                                    <a href="{{route('orcamentos.show', $cliente->id)}}">
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
                "dom": '<"toolbar tool1"><"clear-filter">frtip',
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
            $("div.tool1").css("padding", "7px 20px").html('<h5 class="content-title text-color">Clientes criados esse mês</h5>');

            $('#table2').DataTable({
                "dom": '<"toolbar tool2"><"clear-filter">frtip',
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
            $("div.tool2").css("padding", "7px 20px").html('<h5 class="content-title text-color">Orcamentos criados esse mês</h5>');
        });
    </script>

@endsection