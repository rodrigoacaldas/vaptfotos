<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Evento;
use App\Models\QtdConvidado;
use App\Models\QtdFoto;
use App\Models\TipoEvento;
use App\Models\TipoFoto;
use App\Models\TipoCancelamento;
use App\Models\Conheceu;
use App\Models\MeioContato;
use App\Helpers\functions;
use App\Http\Requests\ClienteFromRequest;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $clientes = Cliente::get();
        $formtitle = "Clientes";

        return view('clientes.index', compact('clientes', 'formtitle'));
    }

    public function create()
    {
        $formtitle = "Cadastro de Clientes";
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();

        return view('clientes.formCliente', compact('formtitle', 'conheceus', 'meiocontatos'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();

        if ($dataForm['primeiroContato'] = 'null') {
            $dataForm['primeiroContato'] = Carbon::now();
        }else{
            $dataForm['primeiroContato'] = functions::bancoData($dataForm['primeiroContato']);
        }

        $insert = $this->cliente->create($dataForm);

        if($insert)
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Sucesso ao cadastrar o cliente');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar cliente');

    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        $cliente['nascimento'] = functions::brasilData($cliente['nascimento']);
        $cliente['primeiroContato'] = functions::brasilData($cliente['primeiroContato']);
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();
        $deletar = true;
        $formtitle = "Deletar de Clientes";

        return view('clientes.formCliente', compact('cliente', 'deletar', 'conheceus', 'meiocontatos', 'formtitle'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $cliente['nascimento'] = functions::brasilData($cliente['nascimento']);
        $cliente['primeiroContato'] = functions::brasilData($cliente['primeiroContato']);
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();
        $formtitle = "Editando cliente";

        return view('clientes.formCliente', compact('cliente', 'conheceus', 'meiocontatos', 'formtitle'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $cliente = Cliente::find($id);
        $dataForm['nascimento'] = functions::bancoData($dataForm['nascimento']);
        $dataForm['primeiroContato'] = functions::bancoData($dataForm['primeiroContato']);

        $update = $cliente->update($dataForm);

        if($update)
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Sucesso ao editar o cliente');

        return redirect()
            ->back()
            ->with('error', 'Falha ao editar cliente');

    }


    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $delete = $cliente->delete();

        if($delete)
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Sucesso ao deletar o cliente');

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar cliente');
    }

    public function resumo($id)
    {
        $cliente = Cliente::find($id);
        $orcamentos = Evento::where('cliente_id', $id)->get();

        return view('clientes.resumo', compact('cliente', 'orcamentos'));
    }

    public function cadastraModal(ClienteFromRequest $request)
    {
        $dataFrom = $request->except('origem', '_token');
        $origem = $request->input('origem');

        if ($dataFrom['primeiroContato'] = 'null') {
            $dataFrom['primeiroContato'] = Carbon::now();
        }else{
            $dataFrom['primeiroContato'] = functions::bancoData($dataFrom['primeiroContato']);
        }

        $dataFrom['created_at'] = Carbon::now();
        $dataFrom['updated_at'] = Carbon::now();

        //faz o cadastro
        $criadoModal = Cliente::insertGetId($dataFrom);

        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $conheceus = Conheceu::get();
        $meiocontatos = MeioContato::get();

        if($origem == 'evento') {
            return view('evento.formEvento', compact('formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos', 'conheceus', 'meiocontatos', 'criadoModal'));
        }
        if($origem == 'orcamento'){
            $novo = true;
            return view('orcamentos.formOrcamento', compact('formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos', 'conheceus', 'meiocontatos', 'criadoModal', 'novo'));
        }
    }
}
