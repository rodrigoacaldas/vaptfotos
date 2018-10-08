<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QtdConvidado;
use App\Http\Requests\QtdConvidadoFromRequest;

class QtdConvidadoController extends Controller
{
    private $qtdconvidado;


    public function __construct(QtdConvidado $qtdconvidado)
    {
        $this->qtdconvidado = $qtdconvidado;
    }

    public function index()
    {
        $qtdconvidados = $this->qtdconvidado->all();
        $formtitle = 'Listagem de quantidade de convidados';

        return view('qtdconvidados.index', compact('qtdconvidados', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de quantidade de convidados';

        return view('qtdconvidados.formqtdconvidados', compact('formtitle'));

    }

    public function store(QtdConvidadoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->qtdconvidado->create($dataFrom);

        if ( $insert )
            return redirect()->route('qtdconvidados.index');
        else
            return redirect()->route('qtdconvidados.create');
    }

    public function show($id)
    {
        $qtdconvidado = $this->qtdconvidado->find($id);
        $formtitle = "Deletar quantidade de convidados: $qtdconvidado->nome";
        $deletar = true;

        return view('qtdconvidados.formqtdconvidados', compact( 'formtitle', 'qtdconvidado', 'deletar'));

    }

    public function edit($id)
    {
        $qtdconvidado = $this->qtdconvidado->find($id);
        $formtitle = "Editar quantidade de convidados: $qtdconvidado->nome";

        return view('qtdconvidados.formqtdconvidados', compact( 'formtitle', 'qtdconvidado'));

    }

    public function update(QtdConvidadoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $qtdconvidado = $this->qtdconvidado->find($id);

        $update = $qtdconvidado->update($dataForm);

        if( $update )
            return redirect()->route('qtdconvidados.index');
        else
            return redirect()->route('qtdconvidados.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $qtdconvidado = $this->qtdconvidado->find($id);

        $delete = $qtdconvidado->delete();

        if( $delete )
            return redirect()->route('qtdconvidados.index');
        else
            return redirect()->route('qtdconvidados.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
