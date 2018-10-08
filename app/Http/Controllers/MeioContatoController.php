<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MeioContato;
use App\Http\Requests\MeioContatoFromRequest;

class MeioContatoController extends Controller
{
    private $meiocontato;


    public function __construct(MeioContato $meiocontato)
    {
        $this->meiocontato = $meiocontato;
    }

    public function index()
    {
        $meiocontatos = $this->meiocontato->all();
        $formtitle = 'Listagem de Meio de contatos';

        return view('meiocontatos.index', compact('meiocontatos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de meio de contatos';

        return view('meiocontatos.formmeiocontatos', compact('formtitle'));

    }

    public function store(MeioContatoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->meiocontato->create($dataFrom);

        if ( $insert )
            return redirect()->route('meiocontatos.index');
        else
            return redirect()->route('meiocontatos.create');
    }

    public function show($id)
    {
        $meiocontato = $this->meiocontato->find($id);
        $formtitle = "Deletar meio de contato: $meiocontato->nome";
        $deletar = true;

        return view('meiocontatos.formmeiocontatos', compact( 'formtitle', 'meiocontato', 'deletar'));

    }

    public function edit($id)
    {
        $meiocontato = $this->meiocontato->find($id);
        $formtitle = "Editar meio de contato: $meiocontato->nome";

        return view('meiocontatos.formmeiocontatos', compact( 'formtitle', 'meiocontato'));

    }

    public function update(MeioContatoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $meiocontato = $this->meiocontato->find($id);

        $update = $meiocontato->update($dataForm);

        if( $update )
            return redirect()->route('meiocontatos.index');
        else
            return redirect()->route('meiocontatos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $meiocontato = $this->meiocontato->find($id);

        $delete = $meiocontato->delete();

        if( $delete )
            return redirect()->route('meiocontatos.index');
        else
            return redirect()->route('meiocontatos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
