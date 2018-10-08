@extends('layouts.app')

@section('content')


        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="content-box">
                    <div class="head success-bg clearfix">
                        <h5 class="content-title pull-left">@if( isset($formtitle)) {{$formtitle}} @endif</h5>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-10">
                                @if( isset($cliente) && isset($deletar) )
                                    <form class="form-horizontal" method="post" action="{{route('clientes.destroy', $cliente->id)}}">
                                    {!! method_field('DELETE') !!}
                                @elseif( isset($cliente) )
                                    <form class="form-horizontal" method="post" action="{{route('clientes.update', $cliente->id)}}">
                                    {!! method_field('PUT') !!}
                                @else
                                    <form class="form-horizontal" action="{{ route('clientes.store') }}" method="post">
                                @endif
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nome" value="{{$cliente->nome or old('nome')}}" placeholder="Nome do cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="telefone" value="{{$cliente->telefone or old('telefone')}}" placeholder="Telefone do cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="{{$cliente->email or old('email')}}" placeholder="Email do cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Primeiro Contato</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker2" type="text" name="primeiroContato" value="{{$cliente->primeiroContato or old('primeiroContato')}}" class="form-control" placeholder="Data do primeiro contato"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Empresa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="empresa" value="{{$cliente->empresa or old('empresa')}}" placeholder="Empresa do cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Endereço</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="endereço" value="{{$cliente->endereço or old('endereço')}}" placeholder="Endereço do cliente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Como conheceu</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="comoconheceu_id">
                                                <option value="8">Como conheceu a vapt</option>
                                                @foreach($conheceus as $conheceu)
                                                    <option value="{{$conheceu->id}}"
                                                            @if( isset($cliente) && ($cliente->comoconheceu_id == $conheceu->id) )
                                                            selected
                                                            @endif
                                                    >{{$conheceu->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Como fez contato</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="meiocontato_id">
                                                <option value="7">Como entrou em contato com a vapt</option>
                                                @foreach($meiocontatos as $meiocontato)
                                                    <option value="{{$meiocontato->id}}"
                                                            @if( isset($cliente) && ($cliente->meiocontato_id == $meiocontato->id) )
                                                            selected
                                                            @endif
                                                    >{{$meiocontato->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
                                        @if(isset($deletar))
                                            <button type="submit" class="btn btn-danger float-right">DELETAR</button>
                                        @else
                                            <button type="submit" class="btn btn-primary float-right">Enviar</button>
                                        @endif
                                    </div>

                                </form>
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

        $("#datetimepicker2").datetimepicker({
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