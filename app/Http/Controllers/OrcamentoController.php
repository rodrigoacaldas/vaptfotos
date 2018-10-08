<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Cliente;
use App\Models\Contato;
use App\Models\QtdConvidado;
use App\Models\QtdFoto;
use App\Models\TipoEvento;
use App\Models\TipoFoto;
use App\Models\TipoCancelamento;
use App\Models\Conheceu;
use App\Models\MeioContato;
use App\Models\Opcao;
use App\Helpers\functions;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrcamentoFromRequest;
use Carbon\Carbon;

class OrcamentoController extends Controller
{
    public function __construct(Evento $orcamento)
    {
        $this->orcamento = $orcamento;
    }

    public function index()
    {
        $orcamentos = Evento::where('status', '=', '0')
        ->where('dtevento', '>=', Carbon::today())
        ->with(['contato' => function($query) {$query->latest()->first();}])
        ->get();

        $formtitle = "Orcamentos cadastrados";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = "Cadastro de um novo Orcamento";
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();
        $novo = true;

        return view('orcamentos.formOrcamento', compact('formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos', 'conheceus', 'meiocontatos', 'novo'));
    }

    public function store(OrcamentoFromRequest $request)
    {
        $dataForm = $request->except('_token', 'data', 'followup', 'meiocontato_id');
        $dataForm['dtevento'] = functions::bancoData($dataForm['dtevento']);

        if ($dataForm['created_at'] == 'null') {
            $dataForm['created_at'] = Carbon::now();
        }else{
            $dataForm['created_at'] = functions::bancoData($dataForm['created_at']);
        }
        $dataForm['updated_at'] = Carbon::now();

        $insert = Evento::insertGetId($dataForm);

        $contato = $request->only('data', 'followup', 'meiocontato_id', 'user_id');
        if ($contato['data'] == 'null') {
            $contato['data'] = Carbon::now();
        }else{
            $contato['data'] = functions::bancoData($contato['data']);
        }
        $contato['evento_id'] = $insert;

        $insert2 = Contato::insert($contato);

        if($insert)
            return redirect()
                ->route('resumoSemanal')
                ->with('success', 'Sucesso ao cadastrar o orcamento e contato');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar orcamento e contato');

    }

    public function show($id)
    {
        $orcamento = Evento::find($id);
        $orcamento['dtevento'] = functions::brasilData($orcamento['dtevento']);
        $deletar = true;
        $formtitle = "Deletar um Orcamento";
        $tipoCancelamentos = TipoCancelamento::get();

        return view('orcamentos.deletarOrcamento', compact('orcamento', 'deletar', 'conheceus', 'formtitle', 'tipoCancelamentos'));
    }

    public function edit($id)
    {
        $orcamento = Evento::find($id);
        $orcamento['dtevento'] = functions::brasilData($orcamento['dtevento']);
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();
        $formtitle = "Editar um orcamento";



        return view('orcamentos.formOrcamento', compact('orcamento', 'conheceus','formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos', 'conheceus', 'meiocontatos'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->except('_token');
        $orcamento = Evento::find($id);
        $dataForm['dtevento'] = functions::bancoData($dataForm['dtevento']);
        $dataForm['created_at'] = functions::bancoData($dataForm['created_at']);

        $update = $orcamento->update($dataForm);

        if($update)
            return redirect()
                ->route('orcamentos.index')
                ->with('success', 'Sucesso ao editar o orcamento');

        return redirect()
            ->back()
            ->with('error', 'Falha ao editar orcamento');

    }

    public function destroy($id)
    {

    }

    public function delete(Request $request, $id)
    {
        DB::table('eventos')->where('id', $id)->update(['status' => 3]);

        $dataForm = $request->all();

        $dataForm['data'] = functions::bancoData($dataForm['data']);
        $cancela = DB::table('cancelamentos')->insert([
            'data' => $dataForm['data'],
            'obs' => $dataForm['obs'],
            'evento_id' => $id,
            'tipocancelamento_id' => $dataForm['tipocancelamento_id'],
            'user_id' => $dataForm['user_id'],
        ]);

        if($cancela)
            return redirect()
                ->route('orcamentos.index')
                ->with('success', 'Sucesso ao deletar o orcamento');

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar orcamento');
    }

    public function passado()
    {
        $orcamentos = Evento::where('status', '=', '0')
            ->where('dtevento', '<', Carbon::today())
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->get();
        $formtitle = "Orcamentos passados";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function cancelado()
    {
        $orcamentos = Evento::where('status', '=', '3')
            ->where('dtevento', '<', Carbon::today())
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->get();
        $formtitle = "Orcamentos cancelados";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function abertosProximosDias()
    {
        $opcoes = Opcao::first();

        $orcamentos = Evento::whereBetween('dtevento', [Carbon::today(), Carbon::today()->addDays($opcoes->proximosDias)])
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->where('status', '=', '0')
            ->get();

        $formtitle = "Orcamentos abertos para os proximos $opcoes->proximosDias dias";

        return view('orcamentos.indexSimples', compact('orcamentos', 'formtitle'));
    }

    public function diasSemRetorno()
    {
        $opcoes = Opcao::first();

        $orcamentos = Evento::whereHas('contato', function ($query) use($opcoes) {$query->where('data', '<=', Carbon::today()->subDays($opcoes->semRetorno));})
            ->with(['contato' => function($query) {$query->latest()->first();}])
            ->where('status', '=', '0')
            ->where('dtevento', '>=',  Carbon::today()->addDays($opcoes->proximosDias))
            ->get();

        $formtitle = "Orçamentos com mais de $opcoes->semRetorno dias sem retorno";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function orcamentoDia($diaCompleto)
    {
        $dia = date( 'd' , strtotime($diaCompleto));
        $mes = date( 'm' , strtotime($diaCompleto));
        $ano = date( 'Y' , strtotime($diaCompleto));

        $orcamentos = Evento::whereDay('created_at', $dia)->whereMonth('created_at', $mes)->whereYear('created_at', $ano)
        ->with(['contato' => function($query) {$query->latest()->first();}])
        ->get();

        $formtitle = "Orçamentos do dia $diaCompleto";

        return view('orcamentos.index', compact('orcamentos', 'formtitle'));
    }

    public function criaOrcamentoSimples()
    {
        $formtitle = "Cadastro de um novo Orcamento Simples";
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();
        $novo = true;

        return view('orcamentos.formOrcamentoSimples', compact('formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos', 'conheceus', 'meiocontatos', 'novo'));
    }

    public function storeSimples(OrcamentoFromRequest $request)
    {

        $dataFormCliente = $request->only('nome', 'telefone', 'meiocontato_id', 'user_id', 'email', 'comoconheceu_id');
        $dataFormCliente['primeiroContato'] = Carbon::now();
        $dataFormCliente['created_at'] = Carbon::now();
        $dataFormCliente['updated_at'] = Carbon::now();
        $insertCliente = Cliente::insertGetId($dataFormCliente);

        $dataFormEvento = $request->except('_token', 'data', 'followup', 'meiocontato_id2', 'nome', 'telefone', 'meiocontato_id', 'email', 'comoconheceu_id');
        $dataFormEvento['dtevento'] = functions::bancoData($dataFormEvento['dtevento']);
        $dataFormEvento['cliente_id'] = $insertCliente;
        if ($dataFormEvento['created_at'] == 'null') {
            $dataFormEvento['created_at'] = Carbon::now();
        }else{
            $dataFormEvento['created_at'] = functions::bancoData($dataFormEvento['created_at']);
        }
        $dataFormEvento['updated_at'] = Carbon::now();
        $insertEvento = Evento::insertGetId($dataFormEvento);

        $dataFormContato = $request->only('data', 'followup', 'meiocontato_id2', 'user_id');
        if ($dataFormContato['data'] = 'null') {
            $dataFormContato['data'] = Carbon::now();
        }else{
            $dataFormContato['data'] = functions::bancoData($dataFormContato['data']);
        }
        $contato['evento_id'] = $insertEvento;
        $dataFormContato['created_at'] = Carbon::now();
        $dataFormContato['updated_at'] = Carbon::now();
        $insertContato = Contato::insert([
            'data' => $dataFormContato['data'],
            'followup' => $dataFormContato['followup'],
            'evento_id' => $insertEvento,
            'meiocontato_id' => $dataFormContato['meiocontato_id2'],
            'user_id' => $dataFormContato['user_id']
        ]);

        if($insertContato)
            return redirect()
                ->route('resumoSemanal')
                ->with('success', 'Sucesso ao cadastrar o orcamento simples e contato');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar orcamento simples e contato');

    }

    public function orcamentoResumo($id)
    {
        $formtitle = "Resumo de Orcamento";

        $orcamento = Evento::find($id);
        $cliente = Cliente::find($orcamento->cliente_id);
        $contatos = Contato::where('evento_id', $id)->get();
        $meiocontatos = MeioContato::get();


        return view('orcamentos.resumo', compact('formtitle', 'orcamento', 'cliente', 'contatos', 'meiocontatos'));
    }

}
