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
                                <form class="form-horizontal" action="{{ route('criaSimples') }}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="status" value="0">

                                    <h4 style="text-align: center">Informações do cliente</h4>
                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nome" value="" placeholder="Nome do cliente">
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
                                        <label class="col-sm-2 control-label">Como conheceu</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="comoconheceu_id">
                                                <option value="8">Sem dado</option>
                                                @foreach($conheceus as $conheceu)
                                                    <option value="{{$conheceu->id}}">{{$conheceu->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Como fez contato</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="meiocontato_id">
                                                <option value="7">Sem dado</option>
                                                @foreach($meiocontatos as $meiocontato)
                                                    <option value="{{$meiocontato->id}}">{{$meiocontato->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <h4 style="text-align: center">Informações do evento</h4>
                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Data</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker1" type="text" name="dtevento" value="{{$orcamento->dtevento or old('dtevento')}}" class="form-control" placeholder="Data do evento"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Quantidade de convidados</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="qtdconvidados_id">
                                                <option value="">Quantidade de convidados</option>
                                                @foreach($qtdconvidados as $qtdconvidado)
                                                    <option value="{{$qtdconvidado->id}}"
                                                            @if( isset($orcamento) && ($orcamento->qtdconvidados_id == $qtdconvidado->id) )
                                                            selected
                                                            @endif
                                                    >{{$qtdconvidado->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tipo de Evento</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="tipoeventos_id">
                                                <option value="">Tipo do evento</option>
                                                @foreach($tipoeventos as $tipoevento)
                                                    <option value="{{$tipoevento->id}}"
                                                            @if( isset($orcamento) && ($orcamento->tipoeventos_id == $tipoevento->id) )
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
                                                            @if( isset($orcamento) && ($orcamento->tipofotos_id == $tipofoto->id) )
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
                                                            @if( isset($orcamento) && ($orcamento->qtdfotos_id == $qtdfoto->id) )
                                                            selected
                                                            @endif
                                                    >{{$qtdfoto->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Observações sobre o orçamento</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="obs" value="{{$orcamento->obs or old('obs')}}" placeholder="Observações sobre o orçamento">
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <label for="inputText" class="col-sm-2 control-label">Data do envio do orçamento</label>
                                            <div class="col-sm-10">
                                                <input id="datetimepicker2" type="text" name="created_at" value="@if( isset($orcamento)) date( 'd/m/Y' , strtotime($orcamento->created_at)) @endif or old('created_at')}}" class="form-control" placeholder="Data do envio do orçamento"/>
                                            </div>
                                        </div>

                                        <h4 style="text-align: center">Informações sobre o contato com o cliente</h4>

                                        <div class="form-group">
                                            <label for="inputText" class="col-sm-2 control-label">Data do contato</label>
                                            <div class="col-sm-10">
                                                <input id="datetimepicker3" type="text" name="data" value="" class="form-control" placeholder="Data do contato">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Como você entrou em contato</label>
                                            <div class="col-sm-10">
                                                <select class="form-control selectpicker" name="meiocontato_id2">
                                                    <option value="">Como você entrou em contato</option>
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
                                                <input type="text" class="form-control" name="followup" value="{{$orcamento->followup or old('followup')}}" placeholder="O que foi conversado">
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

        $("#datetimepicker3").datetimepicker({
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