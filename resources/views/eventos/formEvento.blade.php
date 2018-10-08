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
                                @if( isset($evento) && isset($deletar) )
                                    <form class="form-horizontal" method="post" action="{{route('eventos.destroy', $evento->id)}}">
                                    {!! method_field('DELETE') !!}
                                @elseif( isset($evento) )
                                    <form class="form-horizontal" method="post" action="{{route('eventos.update', $evento->id)}}">
                                    {!! method_field('PUT') !!}
                                @else
                                    <form class="form-horizontal" action="{{ route('eventos.store') }}" method="post">
                                @endif
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="status" value="1">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Cliente</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="cliente_id" data-live-search="true">
                                                <option value="">Cliente do evento</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{$cliente->id}}"
                                                            @if( isset($evento) && ($evento->cliente_id == $cliente->id) )
                                                            selected
                                                            @endif
                                                    >{{$cliente->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Data</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker1" type="text" name="dtevento" value="{{$evento->dtevento or old('dtevento')}}" class="form-control" placeholder="Data do evento"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Horario</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hora" value="{{$evento->hora or old('hora')}}"
                                                   data-mask="00:00" placeholder="00:00" autocomplete="off" maxlength="5">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Quantidade de convidados</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="qtdconvidados_id">
                                                <option value="">Quantidade de convidados</option>
                                                @foreach($qtdconvidados as $qtdconvidado)
                                                    <option value="{{$qtdconvidado->id}}"
                                                            @if( isset($evento) && ($evento->qtdconvidados_id == $qtdconvidado->id) )
                                                            selected
                                                            @endif
                                                    >{{$qtdconvidado->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tipo de evento</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="tipoeventos_id">
                                                <option value="">Tipo do evento</option>
                                                @foreach($tipoeventos as $tipoevento)
                                                    <option value="{{$tipoevento->id}}"
                                                            @if( isset($evento) && ($evento->tipoeventos_id == $tipoevento->id) )
                                                            selected
                                                            @endif
                                                    >{{$tipoevento->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tipo de foto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="tipofotos_id">
                                                <option value="">Tipo de foto</option>
                                                @foreach($tipofotos as $tipofoto)
                                                    <option value="{{$tipofoto->id}}"
                                                            @if( isset($evento) && ($evento->tipofotos_id == $tipofoto->id) )
                                                            selected
                                                            @endif
                                                    >{{$tipofoto->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Quantidade de fotos</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="qtdfotos_id">
                                                <option value="">Quantidade de fotos</option>
                                                @foreach($qtdfotos as $qtdfoto)
                                                    <option value="{{$qtdfoto->id}}"
                                                            @if( isset($evento) && ($evento->qtdfotos_id == $qtdfoto->id) )
                                                            selected
                                                            @endif
                                                    >{{$qtdfoto->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Valor do contrato</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="valorContrato" value="{{$evento->valorContrato or old('valorContrato')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Valor pago antecipadamente</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="valorPago" value="{{$evento->valorPago or old('valorPago')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-2 control-label">Scrapbook</label>
                                            <div class="col-sm-4">
                                                <div class="checkbox checkbox-success ">
                                                    <label><input type="checkbox">
                                                        <i></i></label>
                                                </div>
                                            </div>
                                            <label class="col-sm-2 control-label">Adesivo no totem</label>
                                            <div class="col-sm-4">
                                                <div class="checkbox checkbox-success ">
                                                    <label><input type="checkbox">
                                                        <i></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Observações</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="obs" value="{{$evento->obs or old('obs')}}" rows="3"></textarea>
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

    <script src="/vendor/js/jquery.priceformat.js" type="text/javascript"></script>

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

        $('.money').priceFormat({
            prefix: 'R$ ',
            centsSeparator: ',',
            thousandsSeparator: '.'
        });

    </script>



@endsection