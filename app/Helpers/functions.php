<?php
//app/Helpers/functions.php
namespace App\Helpers;

use App\Models\Evento;
use App\Models\Contato;
use App\Models\Cliente;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class functions
{
    public static function bancoData($data)
    {

        $date = str_replace('/', '-', $data);
        $dataCerta = date('Y-m-d', strtotime($date));
        return ($dataCerta);
    }

    public static function brasilData($data)
    {
        $timestamp = strtotime($data);
        $dataCerta = date('d/m/Y', $timestamp);
        return ($dataCerta);
    }

    public static function mudaDinheiro($request)
    {
        if( isset ($request['valorContrato'])){
            $request['valorContrato'] = str_replace('R$ ','',$request['valorContrato']);
            $request['valorContrato'] = str_replace('.','',$request['valorContrato']);
            $request['valorContrato'] = str_replace(',','.',$request['valorContrato']);
        }
        if( isset ($request['valorPago'])){
            $request['valorPago'] = str_replace('R$ ','',$request['valorPago']);
            $request['valorPago'] = str_replace('.','',$request['valorPago']);
            $request['valorPago'] = str_replace(',','.',$request['valorPago']);
        }

        return($request);
    }

    public static function metaMudaDinheiro($request)
    {

        if( isset ($request['meta1'])){
            $request['meta1'] = str_replace('R$ ','',$request['meta1']);
            $request['meta1'] = str_replace('.','',$request['meta1']);
            $request['meta1'] = str_replace(',','.',$request['meta1']);
        }
        if( isset ($request['meta2'])){
            $request['meta2'] = str_replace('R$ ','',$request['meta2']);
            $request['meta2'] = str_replace('.','',$request['meta2']);
            $request['meta2'] = str_replace(',','.',$request['meta2']);
        }
        if( isset ($request['meta3'])){
            $request['meta3'] = str_replace('R$ ','',$request['meta3']);
            $request['meta3'] = str_replace('.','',$request['meta3']);
            $request['meta3'] = str_replace(',','.',$request['meta3']);
        }
        if( isset ($request['meta4'])){
            $request['meta4'] = str_replace('R$ ','',$request['meta4']);
            $request['meta4'] = str_replace('.','',$request['meta4']);
            $request['meta4'] = str_replace(',','.',$request['meta4']);
        }
        if( isset ($request['meta5'])){
            $request['meta5'] = str_replace('R$ ','',$request['meta5']);
            $request['meta5'] = str_replace('.','',$request['meta5']);
            $request['meta5'] = str_replace(',','.',$request['meta5']);
        }

        return($request);
    }

    public static function qtdOrcamentosNovos ()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);

        $segunda = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 2)
            ->where('user_id', Auth::user()->id)
            ->count();

        $terca = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 3)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quarta = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 4)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quinta = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 5)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sexta = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 6)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sabado = Evento::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(created_at)"), 7)
            ->where('user_id', Auth::user()->id)
            ->count();

        $orcamentosNovos = array(
            "segunda"   => $segunda,
            "terca"     => $terca,
            "quarta"    => $quarta,
            "quinta"    => $quinta,
            "sexta"     => $sexta,
            "sabado"    => $sabado,
            "diaseg" => Carbon::now()->startOfWeek()->addDays(1),
            "diater" => Carbon::now()->startOfWeek()->addDays(2),
            "diaqua" => Carbon::now()->startOfWeek()->addDays(3),
            "diaqui" => Carbon::now()->startOfWeek()->addDays(4),
            "diasex" => Carbon::now()->startOfWeek()->addDays(5),
            "diasab" => Carbon::now()->startOfWeek()->addDays(6),
        );

        return ($orcamentosNovos);
    }

    public static function contatosNovos ()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);

        $diaseg = Carbon::now()->startOfWeek()->addDays(1);
        $diater = Carbon::now()->startOfWeek()->addDays(2);
        $diaqua = Carbon::now()->startOfWeek()->addDays(3);
        $diaqui = Carbon::now()->startOfWeek()->addDays(4);
        $diasex = Carbon::now()->startOfWeek()->addDays(5);
        $diasab = Carbon::now()->startOfWeek()->addDays(6);

        //dd($diaseg->startOfDay());

        $segunda = Contato::whereHas('evento', function ($query) use($diaseg) {$query->whereDate('created_at', '!=', $diaseg);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 2)
            ->where('user_id', Auth::user()->id)
            ->count();


        $terca = Contato::whereHas('evento', function ($query) use($diater) {$query->whereDate('created_at', '!=', $diater);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 3)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quarta = Contato::whereHas('evento', function ($query) use($diaqua) {$query->whereDate('created_at', '!=', $diaqua);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 4)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quinta = Contato::whereHas('evento', function ($query) use($diaqui) {$query->whereDate('created_at', '!=', $diaqui);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 5)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sexta = Contato::whereHas('evento', function ($query) use($diasex) {$query->whereDate('created_at', '!=', $diasex);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 6)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sabado = Contato::whereHas('evento', function ($query) use($diasab) {$query->whereDate('created_at', '!=', $diasab);})
            ->whereBetween('data', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] )
            ->where(DB::raw("DAYOFWEEK(data)"), 7)
            ->where('user_id', Auth::user()->id)
            ->count();

        $contatosNovos = array(
            "segunda"   => $segunda,
            "terca"     => $terca,
            "quarta"    => $quarta,
            "quinta"    => $quinta,
            "sexta"     => $sexta,
            "sabado"    => $sabado
        );

        return ($contatosNovos);
    }

    public static function contratosFechados ()
    {

        $segunda = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 2)
            ->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $terca = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 3)->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quarta = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 4)->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $quinta = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 5)->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sexta = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 6)->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $sabado = Evento::whereBetween('updated_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->where(DB::raw("DAYOFWEEK(updated_at)"), 7)->where('status', 1)
            ->where('user_id', Auth::user()->id)
            ->count();

        $contatosNovos = array(
            "segunda"   => $segunda,
            "terca"     => $terca,
            "quarta"    => $quarta,
            "quinta"    => $quinta,
            "sexta"     => $sexta,
            "sabado"    => $sabado
        );

        return ($contatosNovos);
    }

    public static function resumoMensal ($mesAno)
    {
        $mes = date( 'm' , strtotime($mesAno));
        $ano = date( 'Y' , strtotime($mesAno));

        $orcamentosAbertos = Evento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)->count();

        $eventosFechados = Evento::whereMonth('updated_at', $mes)->whereYear('updated_at', $ano)->where('status', 1)->count();

        $faturamento = Evento::whereMonth('updated_at', $mes)->whereYear('updated_at', $ano)->where('status', 1)->sum('valorContrato');

        $entrada = Evento::whereMonth('updated_at', $mes)->whereYear('updated_at', $ano)->where('status', 1)->sum('valorPago');

        $novosClientes = Cliente::whereMonth('primeiroContato', $mes)->whereYear('primeiroContato', $ano)->count();

        $resumoMensal = array(
            "orcamentosAbertos"   => $orcamentosAbertos,
            "eventosFechados"     => $eventosFechados,
            "faturamento"    => $faturamento,
            "entrada"    => $entrada,
            "novosClientes"     => $novosClientes,
        );

        return ($resumoMensal);
    }

}