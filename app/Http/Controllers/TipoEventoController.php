<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoEvento;
use App\Http\Requests\TipoEventoFromRequest;

class TipoEventoController extends Controller
{
    private $tipoevento;


    public function __construct(TipoEvento $tipoevento)
    {
        $this->tipoevento = $tipoevento;
    }

    public function index()
    {
        $tipoeventos = $this->tipoevento->all();
        $formtitle = 'Listagem de Tipos de eventos';

        return view('tipoeventos.index', compact('tipoeventos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de tipos de eventos';

        return view('tipoeventos.formtipoeventos', compact('formtitle'));

    }

    public function store(TipoEventoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->tipoevento->create($dataFrom);

        if ( $insert )
            return redirect()->route('tipoeventos.index');
        else
            return redirect()->route('tipoeventos.create');
    }

    public function show($id)
    {
        $tipoevento = $this->tipoevento->find($id);
        $formtitle = "Deletar tipo de eventos: $tipoevento->nome";
        $deletar = true;

        return view('tipoeventos.formtipoeventos', compact( 'formtitle', 'tipoevento', 'deletar'));

    }

    public function edit($id)
    {
        $tipoevento = $this->tipoevento->find($id);
        $formtitle = "Editar tipo de evento: $tipoevento->nome";

        return view('tipoeventos.formtipoeventos', compact( 'formtitle', 'tipoevento'));

    }

    public function update(TipoEventoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $tipoevento = $this->tipoevento->find($id);

        $update = $tipoevento->update($dataForm);

        if( $update )
            return redirect()->route('tipoeventos.index');
        else
            return redirect()->route('tipoeventos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $tipoevento = $this->tipoevento->find($id);

        $delete = $tipoevento->delete();

        if( $delete )
            return redirect()->route('tipoeventos.index');
        else
            return redirect()->route('tipoeventos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
