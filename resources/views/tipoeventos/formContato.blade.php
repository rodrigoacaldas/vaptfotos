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
                            <div class="col-md-12" style="text-align: center; font-size: 18px">
                                <strong>Cliente:</strong> @if(isset ($evento->cliente->nome)){{$evento->cliente->nome}}@else Sem dado @endif
                                <strong>Data do evento:</strong> @if(isset ($evento->dtevento)){{ date( 'd/m/Y' , strtotime($evento->dtevento))}}@else Sem dado @endif
                                <strong>Tipo do evento:</strong> @if(isset ($evento->tipoEvento->nome)){{$evento->tipoEvento->nome}}@else Sem dado @endif
                                <strong>Convidados:</strong> @if(isset ($evento->qtdConvidado->nome)){{$evento->qtdConvidado->nome}}@else Sem dado @endif
                                <strong>Tipo de foto:</strong> @if(isset ($evento->tipoFoto->nome)){{$evento->tipoFoto->nome}}@else Sem dado @endif
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-10">
                                @if( isset($contato) && isset($deletar) )
                                    <form class="form-horizontal" method="post" action="{{route('contatos.destroy', $contato->id)}}">
                                    {!! method_field('DELETE') !!}
                                @elseif( isset($contato) )
                                    <form class="form-horizontal" method="post" action="{{route('contatos.update', $contato->id)}}">
                                    {!! method_field('PUT') !!}
                                @else
                                    <form class="form-horizontal" action="{{ route('contatos.store') }}" method="post">
                                @endif
                                    {!! csrf_field() !!}
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="evento_id" value="{{$evento->id}}">

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Data</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker1" type="text" name="data" value="{{$contato->data or old('data')}}" class="form-control" placeholder="Data do contato">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Como de contato</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="meiocontato_id">
                                                <option value="">Como entrou em contato</option>
                                                @foreach($meiocontatos as $meiocontato)
                                                    <option value="{{$meiocontato->id}}"
                                                            @if( isset($contato) && ($contato->meiocontato_id == $meiocontato->id) )
                                                            selected
                                                            @endif
                                                    >{{$meiocontato->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">O que foi conversado</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="followup" rows="3">{{$contato->followup or old('followup')}}</textarea>
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
    <link rel="stylesheet" href="/vendor/bower_components/bootstrap-select/dist/css/bootstrap-select.css">
    <link rel="stylesheet" href="/vendor/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

@endsection

@section('scriptsfoot')
    <script src="/vendor/js/input-mask.min.js"></script>
    <script src="/vendor/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
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