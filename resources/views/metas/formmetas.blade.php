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
                                @if( isset($meta) && isset($deletar) )
                                    <form class="form-horizontal" method="post" action="{{route('metas.destroy', $meta->id)}}">
                                    {!! method_field('DELETE') !!}
                                @elseif( isset($meta) )
                                    <form class="form-horizontal" method="post" action="{{route('metas.update', $meta->id)}}">
                                    {!! method_field('PUT') !!}
                                @else
                                    <form class="form-horizontal" action="{{ route('metas.store') }}" method="post">
                                @endif
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Primeiro dia do mes da meta</label>
                                        <div class="col-sm-10">
                                            <input id="datetimepicker1" type="text" name="mes" value="{{$meta->mes or old('mes')}}" class="form-control" placeholder="Primeiro dia do mes da meta"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Primeira Meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="meta1" value="{{$meta->meta1 or old('meta1')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Segunda Meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="meta2" value="{{$meta->meta2 or old('meta2')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Terceira Meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="meta3" value="{{$meta->meta3 or old('meta3')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Quarta Meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="meta4" value="{{$meta->meta4 or old('meta4')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText" class="col-sm-2 control-label">Quinta Meta</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control money" name="meta5" value="{{$meta->meta5 or old('meta5')}}">
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
    <script src="/vendor/js/input-mask.min.js"></script>
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