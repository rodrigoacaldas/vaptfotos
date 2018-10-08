@extends('layouts.app')

@section('content')
    <h2 class="content-title" style="text-align: center">Resumo do mes de: {{ date( 'm/Y' , strtotime($meta->mes))}}</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h3 class="content-title" style="text-align: center">Resultados</h3>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-2 col-xs-3 col-md-offset-1">
                            <a href="{{route('orcamentoMensal', $meta->mes)}}">
                                <div class="color-container primary-bg">
                                    <span class="color">Orcamentos Abertos</span>
                                    <h2 style="color: #00bcd4">{{array_get($resultados, 'orcamentosAbertos')}}</h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Eventos Fechados</span>
                                <h2 style="color: #00bcd4">{{array_get($resultados, 'eventosFechados')}}</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Faturamento</span>
                                <h2 style="color: #00bcd4">@money(array_get($resultados, 'faturamento'))</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Entrada</span>
                                <h2 style="color: #00bcd4">@money(array_get($resultados, 'entrada'))</h2>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-3">
                            <div class="color-container primary-bg">
                                <span class="color">Novos Clientes</span>
                                <h2 style="color: #00bcd4">{{array_get($resultados, 'novosClientes')}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h4 class="content-title" style="text-align: center">Metas</h4>
                </div>
                <div class="content" style="min-height: 273px;">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="chartjs-container">
                                <canvas id="chart-bar" height="134"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div id="js-legend-bar" class="chart-legend rounded vertical"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="content-box">
                <div class="content">
                    <h3 style="text-align: center">{{$formtitle}}</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mes </th>
                                    <th>Ano </th>
                                    <th>Ação </th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($todasMetas as $todasMeta)
                                <tr>
                                    <td>{{ date( 'm' , strtotime($todasMeta->mes))}}</td>
                                    <td>{{ date( 'Y' , strtotime($todasMeta->mes))}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{route('resumoMensal', $todasMeta->mes)}}">
                                                <span style="padding: 5px" class="btn btn-info raised icon"><i class="zmdi zmdi-eye"></i> </span>
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
        </div>
    </div>
@endsection

@section('scriptshead')



@endsection

@section('scriptsfoot')

    <script src="/vendor/bower_components/Chart.js/Chart.js"></script>
    <script src="/vendor/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.js"></script>


    <script>
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};


        var barChartData = {
            labels : ["Mensal"],
            datasets : [
                {
                    fillColor : "rgba(3, 169, 244, 0.65)",
                    strokeColor : "rgba(3, 169, 244, 0.65)",
                    highlightFill: "rgba(3, 169, 244, 0.75)",
                    highlightStroke: "rgba(3, 169, 244, 1)",
                    label: "Meta 1 @money($meta->meta1)",
                    data : [{{$meta->meta1}}]			},
                {
                    fillColor : "rgba(205, 220, 57, 0.65)",
                    strokeColor : "rgba(205, 220, 57, 0.65)",
                    highlightFill : "rgba(205, 220, 57, 0.75)",
                    highlightStroke : "rgba(205, 220, 57, 1)",
                    label: "Meta 2 @money($meta->meta2)",
                    data : [{{$meta->meta2}}]          },
                {
                    fillColor : "rgba(244, 67, 54, 0.65)",
                    strokeColor : "rgba(244, 67, 54, 0.65)",
                    highlightFill : "rgba(244, 67, 54, 0.75)",
                    highlightStroke : "rgba(244, 67, 54, 1)",
                    label: "Meta 3 @money($meta->meta3)",
                    data : [{{$meta->meta3}}]          },
                {
                    fillColor : "rgba(255, 193, 7, 0.65)",
                    strokeColor : "rgba(255, 193, 7, 0.65)",
                    highlightFill : "rgba(255, 193, 7, 0.75)",
                    highlightStroke : "rgba(255, 193, 7, 1)",
                    label: "Meta 4 @money($meta->meta4)",
                    data : [{{$meta->meta4}}]          },
                {
                    fillColor : "rgba(103, 58, 183, 0.65)",
                    strokeColor : "rgba(103, 58, 183, 0.65)",
                    highlightFill : "rgba(103, 58, 183, 0.75)",
                    highlightStroke : "rgba(103, 58, 183, 1)",
                    label: "Meta 5 @money($meta->meta5)",
                    data : [{{$meta->meta5}}]          },
                {
                    fillColor : "rgba(139, 195, 74, 0.65)",
                    strokeColor : "rgba(139, 195, 74, 0.65)",
                    highlightFill : "rgba(139, 195, 74, 0.75)",
                    highlightStroke : "rgba(139, 195, 74, 1)",
                    label: "Faturamento Atual @money(array_get($resultados, 'faturamento'))",
                    data : [{{array_get($resultados, 'faturamento')}}]			}
            ]

        };

        window.onload = function(){


      var ctx5 = document.getElementById("chart-bar").getContext("2d");
      var myBar = new Chart(ctx5).Bar(barChartData, {
        responsive : true,
        scaleShowVerticalLines: false,
      });

      document.getElementById('js-legend-bar').innerHTML = myBar.generateLegend();
  }

  </script>
@endsection
