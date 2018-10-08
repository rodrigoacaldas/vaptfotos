<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\MeioContato;
use App\Models\Evento;
use App\Models\Conheceu;
use App\Helpers\functions;

class ContatoController extends Controller
{
    public function __construct(Contato $contato)
    {
        $this->contato = $contato;
    }

    public function index()
    {
        $contatos = Contato::get();
        $formtitle = "Contatos com clientes";

        return view('contatos.index', compact('contatos', 'formtitle'));
    }

    public function create($id)
    {
        $formtitle = "Cadastro de Contato com cliente";
        $evento = Evento::find($id);
        $meiocontatos = MeioContato::get();

        return view('contatos.formContato', compact('formtitle','meiocontatos', 'evento'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['data'] = functions::bancoData($dataForm['data']);

        $insert = $this->contato->create($dataForm);

        if($insert)
            return redirect()
                ->route('contatos.index')
                ->with('success', 'Sucesso ao cadastrar o contato');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar contato');

    }

    public function show($id)
    {
        $contato = Contato::find($id);
        $contato['data'] = functions::brasilData($contato['data']);
        $meiocontatos = MeioContato::get();
        $evento = Evento::find($contato->evento_id);
        $deletar = true;
        $formtitle = "Deletar um Contato com cliente";

        return view('contatos.formContato', compact('contato', 'deletar', 'meiocontatos', 'formtitle', 'evento'));
    }

    public function edit($id)
    {
        $meiocontatos = MeioContato::get();
        $contato = Contato::find($id);
        $contato['data'] = functions::brasilData($contato['data']);
        $evento = Evento::find($contato->evento_id);
        $formtitle = "Editar um contato com cliente";

        return view('contatos.formContato', compact('contato', 'formtitle', 'evento', 'meiocontatos'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $contato = Contato::find($id);
        $dataForm['data'] = functions::bancoData($dataForm['data']);

        $update = $contato->update($dataForm);

        if($update)
            return redirect()
                ->route('contatos.index')
                ->with('success', 'Sucesso ao editar o contato');

        return redirect()
            ->back()
            ->with('error', 'Falha ao editar contato');

    }


    public function destroy($id)
    {
        $contato = Contato::find($id);
        $delete = $contato->delete();

        if($delete)
            return redirect()
                ->route('contatos.index')
                ->with('success', 'Sucesso ao deletar o contato');

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar contato');
    }
}
