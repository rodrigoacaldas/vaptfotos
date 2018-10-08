@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="content-box">
                <div class="content">
                    <h3 style="text-align: center">{{$formtitle}}</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th style="text-align: center; width: 90px">Segunda</th>
                                    <th style="text-align: center; width: 90px">Terça</th>
                                    <th style="text-align: center; width: 90px">Quarta</th>
                                    <th style="text-align: center; width: 90px">Quinta</th>
                                    <th style="text-align: center; width: 90px">Sexta</th>
                                    <th style="text-align: center; width: 90px">Sabado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Orçamentos Novos</td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diaseg'))}}">{{array_get($orcamentosNovos, 'segunda')}} </a></td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diater'))}}">{{array_get($orcamentosNovos, 'terca')}}</a></td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diaqua'))}}">{{array_get($orcamentosNovos, 'quarta')}}</a></td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diaqui'))}}">{{array_get($orcamentosNovos, 'quinta')}}</a></td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diasex'))}}">{{array_get($orcamentosNovos, 'sexta')}}</a></td>
                                    <td style="text-align: center"><a href="{{route('orcamentoDia', array_get($orcamentosNovos, 'diasab'))}}">{{array_get($orcamentosNovos, 'sabado')}}</a></td>
                                </tr>
                                <tr>
                                    <td>Contato com prospect</td>
                                    <td style="text-align: center">{{array_get($contatos, 'segunda')}}</td>
                                    <td style="text-align: center">{{array_get($contatos, 'terca')}}</td>
                                    <td style="text-align: center">{{array_get($contatos, 'quarta')}}</td>
                                    <td style="text-align: center">{{array_get($contatos, 'quinta')}}</td>
                                    <td style="text-align: center">{{array_get($contatos, 'sexta')}}</td>
                                    <td style="text-align: center">{{array_get($contatos, 'sabado')}}</td>
                                </tr>
                                <tr>
                                    <td>Contratos fechados</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'segunda')}}</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'terca')}}</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'quarta')}}</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'quinta')}}</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'sexta')}}</td>
                                    <td style="text-align: center">{{array_get($contratosFechados, 'sabado')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                        <th>Ultimo contato</th>
                        <th>FollowUP</th>
                        <th style="width: 150px;">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($listaOrcamentos as $listaOrcamento)
                        <tr>
                            <td>{{ date( 'd/m/Y' , strtotime($listaOrcamento->dtevento))}}</td>
                            <td>{{$listaOrcamento->cliente->nome}}</td>
                            <td>{{$listaOrcamento->cliente->telefone}}</td>
                            <td>{{$listaOrcamento->cliente->email}}</td>
                            <td>@if(isset ($listaOrcamento->ultimoContato->data)){{ date( 'd/m/Y' , strtotime($listaOrcamento->ultimoContato->data)) }}@else Sem dado @endif</td>
                            <td>@if(isset ($listaOrcamento->ultimoContato->followup)){{ $listaOrcamento->ultimoContato->followup }}@else Sem dado @endif</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('criaEvento', $listaOrcamento->id)}}">
                                        <span style="padding: 5px" class="btn btn-success raised icon"><i class="zmdi zmdi-money"></i> </span>
                                    </a>
                                    <a href="{{route('criaContato', $listaOrcamento->id)}}">
                                        <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-phone"></i> </span>
                                    </a>
                                    <a href="{{route('orcamentos.edit', $listaOrcamento->id)}}">
                                        <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-edit"></i> </span>
                                    </a>
                                    <a href="{{route('orcamentos.show', $listaOrcamento->id)}}">
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
                <table id="table2" class="display datatable">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Evento</th>
                        <th>Data do evento</th>
                        <th>FollowUP</th>
                        <th style="width: 100px;">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($listaContatos as $listaContatos)
                        <tr>
                            <td>{{ date( 'd/m/Y' , strtotime($listaContatos->data))}}</td>
                            <td>{{$listaContatos->evento->cliente->nome}}</td>
                            <td>{{$listaContatos->evento->cliente->telefone}}</td>
                            <td>{{$listaContatos->evento->cliente->email}}</td>
                            <td>@if(isset ($listaContatos->evento->tipoEvento->nome)) {{$listaContatos->evento->tipoEvento->nome}} @else Sem dado @endif</td>
                            <td>{{$listaContatos->evento->dtevento}}</td>
                            <td>{{$listaContatos->followup}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('contatos.edit', $listaContatos->id)}}">
                                        <span style="padding: 5px" class="btn btn-success raised icon"><i class="zmdi zmdi-edit"></i> </span>
                                    </a>
                                    <a href="{{route('contatos.show', $listaContatos->id)}}">
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
        //Data Tables
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
        $("div.tool1").css("padding", "7px 20px").html('<h5 class="content-title text-color">Orçamentos feito essa semana</h5>');

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
        $("div.tool2").css("padding", "7px 20px").html('<h5 class="content-title text-color">Contatos feitos essa semana</h5>');
    </script>

@endsection

