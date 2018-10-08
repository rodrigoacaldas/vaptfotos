<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Contato;
use App\Models\Cliente;
use App\Models\Opcao;
use App\Models\Meta;
use App\Helpers\functions;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index ()
    {
        return view('login');
    }

    public function home ()
    {
        $opcoes = Opcao::first();

        $orcamentos = Evento::whereMonth('created_at', date( 'm' , strtotime(Carbon::today())))
            ->whereYear('created_at', date( 'Y' , strtotime(Carbon::today())))
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->get();

        $clientes = Cliente::whereMonth('created_at', date( 'm' , strtotime(Carbon::today())))
            ->whereYear('created_at', date( 'Y' , strtotime(Carbon::today())))
            ->get();
        $resultados = functions::resumoMensal(Carbon::today());
        $meta = Meta::whereMonth('mes', date( 'm' , strtotime(Carbon::today())))->whereYear('mes', date( 'Y' , strtotime(Carbon::today())))->first();
        $formtitle = "Tela Inicial";

        return view('home', compact('clientes', 'formtitle', 'orcamentos', 'resultados', 'meta'));
    }

    public function semanal ()
    {

        $formtitle = "Resumo dessa semana";

        $orcamentosNovos = functions::qtdOrcamentosNovos();
        $listaOrcamentos = Evento::whereBetween('created_at', [Carbon::now(Carbon::setWeekStartsAt(Carbon::MONDAY))->startOfWeek(),Carbon::now(Carbon::setWeekStartsAt(Carbon::SUNDAY))->endOfWeek()])->where('status', '!=', 3)->get();
        $contatos = functions::contatosNovos();
        $listaContatos = Contato::whereBetween('data', [Carbon::now(Carbon::setWeekStartsAt(Carbon::MONDAY))->startOfWeek(),Carbon::now(Carbon::setWeekStartsAt(Carbon::SUNDAY))->endOfWeek()])->get();
        $contratosFechados = functions::contratosFechados();

        return view('resumos.semanal', compact( 'formtitle', 'orcamentosNovos', 'contatos', 'listaContatos', 'listaOrcamentos', 'contratosFechados'));
    }

    public function Mensal ($data)
    {
        $formtitle = "Resumo Mensal";
        $todasMetas = Meta::get();

        if($data == 'atual'){
            $resultados = functions::resumoMensal(Carbon::today());
            $meta = Meta::whereMonth('mes', date( 'm' , strtotime(Carbon::today())))->whereYear('mes', date( 'Y' , strtotime(Carbon::today())))->first();
        }
        else{
            $resultados = functions::resumoMensal($data);
            $meta = Meta::whereMonth('mes', date( 'm' , strtotime($data)))->whereYear('mes', date( 'Y' , strtotime($data)))->first();
        }


        return view('resumos.mensal', compact( 'formtitle', 'resultados', 'meta', 'todasMetas'));
    }

    public function orcamentoMensal($mesAno)
    {
        $mes = date( 'm' , strtotime($mesAno));
        $ano = date( 'Y' , strtotime($mesAno));

        $orcamentos = Evento::whereMonth('created_at', $mes)->whereYear('created_at', $ano)
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->get();

        $formtitle = "Orcamentos do mes $mes do ano de $ano";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function bloqueado ()
    {
        return view('bloqueado');
    }
}
