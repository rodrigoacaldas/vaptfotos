<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoCancelamento;
use App\Http\Requests\TipoCancelamentoFromRequest;

class TipoCancelamentoController extends Controller
{
    private $tipocancelamento;


    public function __construct(TipoCancelamento $tipocancelamento)
    {
        $this->tipocancelamento = $tipocancelamento;
    }

    public function index()
    {
        $tipocancelamentos = $this->tipocancelamento->all();
        $formtitle = 'Listagem de tipos de cancelamento';

        return view('tipocancelamentos.index', compact('tipocancelamentos', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de tipos de cancelamento';

        return view('tipocancelamentos.formtipocancelamentos', compact('formtitle'));

    }

    public function store(TipoCancelamentoFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->tipocancelamento->create($dataFrom);

        if ( $insert )
            return redirect()->route('tipocancelamentos.index');
        else
            return redirect()->route('tipocancelamentos.create');
    }

    public function show($id)
    {
        $tipocancelamento = $this->tipocancelamento->find($id);
        $formtitle = "Deletar tipo de cancelamento: $tipocancelamento->nome";
        $deletar = true;

        return view('tipocancelamentos.formtipocancelamentos', compact( 'formtitle', 'tipocancelamento', 'deletar'));

    }

    public function edit($id)
    {
        $tipocancelamento = $this->tipocancelamento->find($id);
        $formtitle = "Editar tipo de cancelamento: $tipocancelamento->nome";

        return view('tipocancelamentos.formtipocancelamentos', compact( 'formtitle', 'tipocancelamento'));

    }

    public function update(TipoCancelamentoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $tipocancelamento = $this->tipocancelamento->find($id);

        $update = $tipocancelamento->update($dataForm);

        if( $update )
            return redirect()->route('tipocancelamentos.index');
        else
            return redirect()->route('tipocancelamentos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $tipocancelamento = $this->tipocancelamento->find($id);

        $delete = $tipocancelamento->delete();

        if( $delete )
            return redirect()->route('tipocancelamentos.index');
        else
            return redirect()->route('tipocancelamentos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
