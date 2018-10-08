<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Cliente;
use App\Models\QtdConvidado;
use App\Models\QtdFoto;
use App\Models\TipoEvento;
use App\Models\TipoFoto;
use App\Models\Conheceu;
use App\Http\Requests\EventoFromRequest;
use App\Helpers\functions;
use Carbon\Carbon;

class EventoController extends Controller
{
    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function index()
    {
        $eventos = Evento::with(['contato' => function($query) {$query->latest()->first();}])
            ->where('status', '=', '1')
            ->where('dtevento', '>=', Carbon::today())
            ->get();
        $formtitle = "Eventos cadastrados";

        return view('eventos.index', compact('eventos', 'formtitle'));
    }

    public function create($id)
    {
        $formtitle = "Fechar um orçamento";
        $evento = Evento::find($id);
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();

        return view('eventos.formEvento', compact('formtitle', 'evento', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos'));
    }

    public function store(EventoFromRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['dtevento'] = functions::bancoData($dataForm['dtevento']);
        $dataForm = functions::mudaDinheiro($dataForm);

        $insert = $this->evento->create($dataForm);

        if($insert)
            return redirect()
                ->route('eventos.index')
                ->with('success', 'Sucesso ao cadastrar o evento');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar evento');

    }

    public function show($id)
    {
        $evento = Evento::find($id);
        $evento['dtevento'] = functions::brasilData($evento['dtevento']);
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $deletar = true;
        $formtitle = "Deletar um Evento";

        return view('eventos.formEvento', compact('evento', 'deletar', 'formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos'));
    }

    public function edit($id)
    {
        $evento = Evento::find($id);
        $evento['dtevento'] = functions::brasilData($evento['dtevento']);
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();
        $formtitle = "Editar um evento";

        return view('eventos.formEvento', compact('evento', 'formtitle', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos'));
    }

    public function update(EventoFromRequest $request, $id)
    {
        $dataForm = $request->all();
        $evento = Evento::find($id);
        $dataForm['dtevento'] = functions::bancoData($dataForm['dtevento']);
        $dataForm = functions::mudaDinheiro($dataForm);

        $update = $evento->update($dataForm);

        if($update)
            return redirect()
                ->route('eventos.index')
                ->with('success', 'Sucesso ao editar o evento');

        return redirect()
            ->back()
            ->with('error', 'Falha ao editar evento');

    }


    public function destroy($id)
    {
        $evento = Evento::find($id);
        $delete = $evento->delete();

        if($delete)
            return redirect()
                ->route('eventos.index')
                ->with('success', 'Sucesso ao deletar o evento');

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar evento');
    }

    public function fechaContrato($id)
    {
        $formtitle = "Fechar um orçamento";
        $evento = Evento::find($id);
        $clientes = Cliente::get();
        $qtdconvidados = QtdConvidado::get();
        $qtdfotos = QtdFoto::get();
        $tipoeventos = TipoEvento::get();
        $tipofotos = TipoFoto::get();

        return view('eventos.formEvento', compact('formtitle', 'evento', 'clientes', 'qtdconvidados', 'qtdfotos', 'tipoeventos', 'tipofotos'));
    }

    public function passado()
    {
        $eventos = Evento::with(['contato' => function($query) {$query->latest()->first();}])
            ->where('status', '=', '1')
            ->where('dtevento', '<', Carbon::today())
            ->get();
        $formtitle = "Eventos passados";

        return view('eventos.index', compact('eventos', 'formtitle'));
    }
}
