@extends('layouts.app')

@section('content')


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="content-box">
                    <div class="head success-bg clearfix">
                        <h4 class="content-title pull-left">Resumo do cliente: <strong>{{$cliente->nome}} </strong></h4>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                @forelse($orcamentos as $orcamento)
                                    <h4>Orçamento com ID: {{$orcamento->id}} criado no dia {{ date( 'd/m/Y' , strtotime($orcamento->created_at))}}</h4>
                                    <div class="table-responsive alt-table">
                                        <table class="table table-hover table-bordered">
                                            @if($orcamento->status == '3')
                                                <caption style="color: red">Esse orçamento foi deletado.</caption>
                                            @endif
                                            <thead>
                                                <tr>
                                                    <th style="width: 250px">Data</th>
                                                    <th>Meio de contato</th>
                                                    <th>FollowUP</th>
                                                </tr>
                                            </thead>
                                            @foreach($orcamento->contato as $contato)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ date( 'd/m/Y' , strtotime($contato->data))}}</td>
                                                        <td>{{$contato->meioContato->nome}}</td>
                                                        <td>{{$contato->followup}}</td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                            @if($orcamento->status == '3')
                                                <tbody>
                                                    <tr>
                                                        <th>Data: {{$orcamento->cancelamento->data}}</th>
                                                        <th>PQ: {{$orcamento->cancelamento->tipoCancelamento->nome}}</th>
                                                        <th>Obs: {{$orcamento->cancelamento->obs}}</th>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                @empty
                                    <tr> <td style="text-align: center;" colspan="6"> Nada a mostrar!!! </td></tr>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('scriptshead')

    <link rel="stylesheet" href="/vendor/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

@endsection

@section('scriptsfoot')
    <script src="/vendor/bower_components/moment/moment-with-locales.min.js"></script>
    <script src="/vendor/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        $("#datetimepicker1").datetimepicker({
            icons: {
                time: "zmdi zmdi-time",
                date: "zmdi zmdi-calendar",
                up: "zmdi zmdi-chevron-up",
                down: "zmdi zmdi-chevron-down",
                previous: "zmdi zmdi-chevron-left",
                next: "zmdi zmdi-chevron-right"
            },
            format: 'DD/MM/YYYY',
            locale: 'pt-br',

        });
    </script>

@endsection