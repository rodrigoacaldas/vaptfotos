<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoFoto;
use App\Http\Requests\TipoFotoFromRequest;

class TipoFotoController extends Controller
{
    private $tipofoto;


    public function __construct(TipoFoto $tipofoto)
    {
        $this->tipofoto = $tipofoto;
    }

    public function index()
    {
        $tipofotos = $this->tipofoto->all();
        $formtitle = 'Listagem de tipos de foto';

        return view('tipofotos.index', compact('tipofotos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de tipo de foto';

        return view('tipofotos.formtipofotos', compact('formtitle'));

    }

    public function store(TipoFotoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->tipofoto->create($dataFrom);

        if ( $insert )
            return redirect()->route('tipofotos.index');
        else
            return redirect()->route('tipofotos.create');
    }

    public function show($id)
    {
        $tipofoto = $this->tipofoto->find($id);
        $formtitle = "Deletar tipo de foto: $tipofoto->nome";
        $deletar = true;

        return view('tipofotos.formtipofotos', compact( 'formtitle', 'tipofoto', 'deletar'));

    }

    public function edit($id)
    {
        $tipofoto = $this->tipofoto->find($id);
        $formtitle = "Editar tipo de foto: $tipofoto->nome";

        return view('tipofotos.formtipofotos', compact( 'formtitle', 'tipofoto'));

    }

    public function update(TipoFotoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $tipofoto = $this->tipofoto->find($id);

        $update = $tipofoto->update($dataForm);

        if( $update )
            return redirect()->route('tipofotos.index');
        else
            return redirect()->route('tipofotos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $tipofoto = $this->tipofoto->find($id);

        $delete = $tipofoto->delete();

        if( $delete )
            return redirect()->route('tipofotos.index');
        else
            return redirect()->route('tipofotos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
