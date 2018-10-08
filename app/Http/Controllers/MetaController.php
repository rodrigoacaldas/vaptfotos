<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Cliente;
use App\Http\Requests\MetaFromRequest;
use App\Helpers\functions;
use Carbon\Carbon;

class MetaController extends Controller
{
    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function index()
    {
        $metas = Meta::get();
        $formtitle = "Metas cadastradas";

        return view('metas.index', compact('metas', 'formtitle'));
    }

    public function create()
    {
        $formtitle = "Criar uma meta";

        return view('metas.formmetas', compact('formtitle'));
    }

    public function store(MetaFromRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['mes'] = functions::bancoData($dataForm['mes']);
        $dataForm = functions::metaMudaDinheiro($dataForm);

        $insert = $this->meta->create($dataForm);

        if($insert)
            return redirect()
                ->route('metas.index')
                ->with('success', 'Sucesso ao cadastrar o meta');

        return redirect()
            ->back()
            ->with('error', 'Falha ao cadastrar meta');

    }

    public function show($id)
    {
        $meta = Meta::find($id);
        $meta['mes'] = functions::brasilData($meta['mes']);

        $deletar = true;
        $formtitle = "Deletar uma Meta";

        return view('metas.formmetas', compact('meta', 'deletar', 'formtitle'));
    }

    public function edit($id)
    {
        $meta = Meta::find($id);
        $meta['mes'] = functions::brasilData($meta['mes']);

        $formtitle = "Editar um meta";

        return view('metas.formmetas', compact('meta', 'formtitle'));
    }

    public function update(MetaFromRequest $request, $id)
    {
        $dataForm = $request->all();
        $meta = Meta::find($id);
        $dataForm['mes'] = functions::bancoData($dataForm['mes']);
        $dataForm = functions::metaMudaDinheiro($dataForm);

        $update = $meta->update($dataForm);

        if($update)
            return redirect()
                ->route('metas.index')
                ->with('success', 'Sucesso ao editar o meta');

        return redirect()
            ->back()
            ->with('error', 'Falha ao editar meta');

    }


    public function destroy($id)
    {
        $meta = Meta::find($id);
        $delete = $meta->delete();

        if($delete)
            return redirect()
                ->route('metas.index')
                ->with('success', 'Sucesso ao deletar o meta');

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar meta');
    }

}
