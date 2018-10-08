<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conheceu;
use App\Http\Requests\ConheceuFromRequest;

class ConheceuController extends Controller
{
    private $conheceu;


    public function __construct(Conheceu $conheceu)
    {
        $this->conheceu = $conheceu;
    }

    public function index()
    {
        $conheceus = $this->conheceu->all();
        $formtitle = 'Listagem de Ocasiões';

        return view('conheceus.index', compact('conheceus', 'formtitle'));
    }

    public function create()
    {
        $formtitle = 'Cadastro de conheceus';

        return view('conheceus.formconheceus', compact('formtitle'));

    }

    public function store(ConheceuFromRequest $request)
    {
        $dataFrom = $request->all();

        //faz o cadastro
        $insert = $this->conheceu->create($dataFrom);
        
        if ( $insert )
            return redirect()->route('conheceus.index');
        else
            return redirect()->route('conheceus.create');
    }

    public function show($id)
    {
        $conheceu = $this->conheceu->find($id);
        $formtitle = "Deletar conheceu: $conheceu->nome";
        $deletar = true;

        return view('conheceus.formconheceus', compact( 'formtitle', 'conheceu', 'deletar'));

    }
    
    public function edit($id)
    {
        $conheceu = $this->conheceu->find($id);
        $formtitle = "Editar conheceu: $conheceu->nome";

        return view('conheceus.formconheceus', compact( 'formtitle', 'conheceu'));

    }

    public function update(ConheceuFromRequest $request, $id)
    {
        $dataForm = $request->all();

        $conheceu = $this->conheceu->find($id);

        $update = $conheceu->update($dataForm);

        if( $update )
            return redirect()->route('conheceus.index');
        else
            return redirect()->route('conheceus.edit', $id->with(['errors' => 'Falha ao editar!']));
    }
    
    public function destroy($id)
    {
        $conheceu = $this->conheceu->find($id);

        $delete = $conheceu->delete();

        if( $delete )
            return redirect()->route('conheceus.index');
        else
            return redirect()->route('conheceus.show', $id->with(['errors' => 'Falha ao excluir!']));

    }
}
