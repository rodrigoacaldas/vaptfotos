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
                                <strong>Cliente:</strong> @if(isset ($orcamento->cliente->nome)){{$orcamento->cliente->nome}}@else Sem dado @endif
                                <strong>Data do evento:</strong> @if(isset ($orcamento->dtevento)){{ date( 'd/m/Y' , strtotime($orcamento->dtevento))}}@else Sem dado @endif
                                <strong>Tipo do evento:</strong> @if(isset ($orcamento->tipoEvento->nome)){{$orcamento->tipoEvento->nome}}@else Sem dado @endif
                                <strong>Convidados:</strong> @if(isset ($orcamento->qtdConvidado->nome)){{$orcamento->qtdConvidado->nome}}@else Sem dado @endif
                                <strong>Tipo de foto:</strong> @if(isset ($orcamento->tipoFoto->nome)){{$orcamento->tipoFoto->nome}}@else Sem dado @endif
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-md-10">
                                    <form class="form-horizontal" method="post" action="{{route('deleteOrcamento', $orcamento->id)}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Porque não quer</label>
                                        <div class="col-sm-10">
                                            <select class="form-control selectpicker" name="tipocancelamento_id" data-live-search="true">
                                                <option value="">Porque não quer</option>
                                                @foreach($tipoCancelamentos as $tipoCancelamento)
                                                    <option value="{{$tipoCancelamento->id}}" >{{$tipoCancelamento->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Data</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker1" type="text" name="data" value="{{old('data')}}" class="form-control" placeholder="Data do contato"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Observações</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="obs" value="{{old('obs')}}" rows="3"></textarea>
                                        </div>
                                    </div>


                                    <div class="card-footer">
                                        <a href="{{ url()->previous() }}"><span class="btn btn-info">Voltar </span></a>
                                        <button type="submit" class="btn btn-danger float-right">DELETAR</button>
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