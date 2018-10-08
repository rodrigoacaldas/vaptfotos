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
                                @if( isset($qtdconvidado) && isset($deletar) )
                                    <form class="form-horizontal" method="post" action="{{route('qtdconvidados.destroy', $qtdconvidado->id)}}">
                                    {!! method_field('DELETE') !!}
                                @elseif( isset($qtdconvidado) )
                                    <form class="form-horizontal" method="post" action="{{route('qtdconvidados.update', $qtdconvidado->id)}}">
                                    {!! method_field('PUT') !!}
                                @else
                                    <form class="form-horizontal" action="{{ route('qtdconvidados.store') }}" method="post">
                                @endif
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nome" value="{{$qtdconvidado->nome or old('nome')}}" placeholder="Como qtdconvidado">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Descrição</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="descricao" value="{{$qtdconvidado->descricao or old('descricao')}}" placeholder="Descrição">
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