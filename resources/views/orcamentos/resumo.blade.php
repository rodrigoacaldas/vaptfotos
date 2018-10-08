@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="content-box timeline">
            <div class="head clearfix">
                <h3 style="text-align: center" class="content-title text-color pull-left">{{$formtitle}}</h3>
            </div>

            <div class="content">
                <section id="cd-timeline" class="cd-container">

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img info-bg">
                            <i class="zmdi zmdi-account"></i>
                        </div>

                        <div class="cd-timeline-content info-bg white">
                            <div class="clearfix" >
                                <h4 class="m-t-0 m-b-10" style="text-align: center">Resumo do cliente</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="font-size: 18px">
                                    <div class="col-lg-6">
                                        <p><strong>Nome: </strong> {{$cliente->nome}} </p>
                                        <p><strong>Telefone: </strong> {{$cliente->telefone}}</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p> <strong>Primeiro Contato: </strong> {{$cliente->meioContato->nome}}</p>
                                        <p><strong>Email: </strong> {{$cliente->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-lg btn-primary raised cd-read-more">Editar Cliente</button>
                            <span class="cd-date info-color">Criado: {{ date( 'd/m/Y' , strtotime($cliente->created_at))}}</span>
                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img info-bg">
                            <i class="zmdi zmdi-view-headline"></i>
                        </div>

                        <div class="cd-timeline-content info-bg white">
                            <div class="clearfix">
                                <h4 class="m-t-0 m-b-10" style="text-align: center">Resumo do Orçamento</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="font-size: 18px">
                                    <div class="col-lg-6">
                                        <p><strong>Data do evento: </strong> {{ date( 'd/m/Y' , strtotime($orcamento->dtevento))}} </p>
                                        <p><strong>Qtd Convidados: </strong> @if(isset ($orcamento->qtdConvidado->nome)){{ $orcamento->qtdConvidado->nome }}@else Sem dado @endif </p>
                                        <p><strong>Tipo fotos: </strong> @if(isset ($orcamento->tipoFoto->nome)){{ $orcamento->qtdConvidado->nome }}@else Sem dado @endif </p>

                                    </div>
                                    <div>
                                        <p><strong>Tipo de evento: </strong> @if(isset ($orcamento->tipoEvento->nome)){{ $orcamento->qtdConvidado->nome }}@else Sem dado @endif </p>
                                        <p><strong>Qtd Fotos: </strong> @if(isset ($orcamento->qtdFotos->nome)){{ $orcamento->qtdConvidado->nome }}@else Sem dado @endif </p>
                                        <p><strong>Observação: </strong> {{ $orcamento->obs }} </p>
                                    </div>
                                </div>
                            </div>
                            <button href="{{route('orcamentos.edit', $orcamento->id)}}" type="button" class="btn btn-lg btn-primary raised cd-read-more">Editar Orçamento</button>
                            <span class="cd-date info-color">Criado: {{ date( 'd/m/Y' , strtotime($orcamento->created_at))}}</span>
                        </div>
                    </div>

                    @forelse($contatos as $contato)
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img success-bg">
                                <i class="zmdi zmdi-check"></i>
                            </div>

                            <div class="cd-timeline-content success-bg white">
                                <div class="clearfix">
                                    <h4 class="m-t-0 m-b-10" style="text-align: center">Contato</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12" style="font-size: 18px">
                                        <p><strong>Nome: </strong> {{$contato->meioContato->nome}} </p>
                                        <p><strong>Telefone: </strong> {{$contato->followup}} </p>
                                    </div>
                                </div>
                                <span class="cd-date success-color">Criado: {{ date( 'd/m/Y' , strtotime($contato->data))}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-content success-bg white">
                                <div class="clearfix">
                                    <h5 class="m-t-0 m-b-10 pull-left">Contato</h5>
                                </div>
                                <h4>Orçamento sem nenhum contato</h4>
                            </div>
                        </div>
                    @endforelse

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img success-bg">
                            <i class="zmdi zmdi-check"></i>
                        </div>

                        <div class="cd-timeline-content success-bg white">
                            <div class="clearfix">
                                <h4 class="m-t-0 m-b-10" style="text-align: center">Novo Contato</h4>
                            </div>
                            <form class="form-horizontal" action="{{ route('contatos.store') }}" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="evento_id" value="{{$orcamento->id}}">

                                <div class="form-group">
                                    <label for="inputText" class="col-sm-2 control-label">Data</label>
                                    <div class="col-sm-10">
                                        <input id="datetimepicker1" type="text" name="data" value="" class="form-control" placeholder="Data do contato">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Como de contato</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" name="meiocontato_id">
                                            <option value="8">Sem dado</option>
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
                                        <input type="text" class="form-control" name="followup" value="" placeholder="O que foi conversado">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Enviar</button>
                            </form>
                        </div>
                    </div>
                <div></div>
                </section>
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