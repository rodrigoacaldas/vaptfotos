<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QtdFoto;
use App\Http\Requests\QtdFotoFromRequest;

class QtdFotoController extends Controller
{
    private $qtdfoto;


    public function __construct(QtdFoto $qtdfoto)
    {
        $this->qtdfoto = $qtdfoto;
    }

    public function index()
    {
        $qtdfotos = $this->qtdfoto->all();
        $formtitle = 'Listagem de quantidade de fotos';

        return view('qtdfotos.index', compact('qtdfotos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de quantidade de fotos';

        return view('qtdfotos.formqtdfotos', compact('formtitle'));

    }

    public function store(QtdFotoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->qtdfoto->create($dataFrom);

        if ( $insert )
            return redirect()->route('qtdfotos.index');
        else
            return redirect()->route('qtdfotos.create');
    }

    public function show($id)
    {
        $qtdfoto = $this->qtdfoto->find($id);
        $formtitle = "Deletar quantidade de fotos: $qtdfoto->nome";
        $deletar = true;

        return view('qtdfotos.formqtdfotos', compact( 'formtitle', 'qtdfoto', 'deletar'));

    }

    public function edit($id)
    {
        $qtdfoto = $this->qtdfoto->find($id);
        $formtitle = "Editar quantidade de fotos: $qtdfoto->nome";

        return view('qtdfotos.formqtdfotos', compact( 'formtitle', 'qtdfoto'));

    }

    public function update(QtdFotoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $qtdfoto = $this->qtdfoto->find($id);

        $update = $qtdfoto->update($dataForm);

        if( $update )
            return redirect()->route('qtdfotos.index');
        else
            return redirect()->route('qtdfotos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $qtdfoto = $this->qtdfoto->find($id);

        $delete = $qtdfoto->delete();

        if( $delete )
            return redirect()->route('qtdfotos.index');
        else
            return redirect()->route('qtdfotos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
