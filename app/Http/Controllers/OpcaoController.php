<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Opcao;
use App\Http\Requests\OpcaoFromRequest;

class OpcaoController extends Controller
{
    private $opcao;


    public function __construct(Opcao $opcao)
    {
        $this->opcao = $opcao;
    }

    public function index()
    {
        $opcao = $this->opcao->find(1);
        $formtitle = 'Listagem das Opções';

        return view('opcaos.formopcaos', compact('opcao', 'formtitle'));
    }

    public function create()
    {
        //Não utilizada
        $formtitle = 'Cadastro de opcaos';
        return view('opcaos.formopcaos', compact('formtitle'));
    }

    public function store(OpcaoFromRequest $request)
    {
        //Não utilizada
        $dataFrom = $request->all();
        //faz o cadastro
        $insert = $this->opcao->create($dataFrom);
        if ( $insert )
            return redirect()->route('opcaos.index');
        else
            return redirect()->route('opcaos.create');
    }

    public function show($id)
    {
        //Não utilizada
        $opcao = $this->opcao->find($id);
        $formtitle = "Deletar opcao: $opcao->nome";
        $deletar = true;
        return view('opcaos.formopcaos', compact( 'formtitle', 'opcao', 'deletar'));

    }

    public function edit($id)
    {
        //Não utilizada
        $opcao = $this->opcao->find($id);
        $formtitle = "Editar opcao: $opcao->nome";
        return view('opcaos.formopcaos', compact( 'formtitle', 'opcao'));

    }

    public function update(OpcaoFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $opcao = $this->opcao->find($id);

        $update = $opcao->update($dataForm);

        if( $update )
            return redirect()->route('opcaos.formopcaos');
        else
            return redirect()->route('opcaos.edit', $id->with(['errors' => 'Falha ao editar!']));
    }

    public function destroy($id)
    {
        $opcao = $this->opcao->find($id);

        $delete = $opcao->delete();

        if( $delete )
            return redirect()->route('opcaos.index');
        else
            return redirect()->route('opcaos.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
