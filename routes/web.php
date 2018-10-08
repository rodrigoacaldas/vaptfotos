<?php

//$this->get('/bloqueado', 'SiteController@bloqueado')->name('bloqueado');

$this->group(['middleware' => ['auth']], function () {
    //Variados
    $this->get('contatos/novo/{id}', 'ContatoController@create')->name('criaContato');
    $this->get('clientes/resumo/{id}', 'ClienteController@resumo')->name('resumoCliente');
    $this->get('orcamento/fecha/{id}', 'EventoController@fechaContrato')->name('criaEvento');
    $this->post('orcamento/delete/{id}', 'OrcamentoController@delete')->name('deleteOrcamento');
    $this->get('orcamento/dia/{id}', 'OrcamentoController@orcamentoDia')->name('orcamentoDia');

    //orcamento simples
    $this->get('orcamento/novoSimples', 'OrcamentoController@criaOrcamentoSimples')->name('novoSimples');
    $this->post('orcamento/criaSimples', 'OrcamentoController@storeSimples')->name('criaSimples');
    $this->get('orcamento/orcamentoResumo/{id}', 'OrcamentoController@orcamentoResumo')->name('orcamentoResumo');

    //Outras Listas
    $this->get('outras/orcamentopassado', 'OrcamentoController@passado')->name('orcamentoPassado');
    $this->get('outras/cancelado', 'OrcamentoController@cancelado')->name('orcamentoCancelado');
    $this->get('outras/eventopassado', 'EventoController@passado')->name('eventoPassado');
    $this->get('outras/abertosproximos', 'OrcamentoController@abertosProximosDias')->name('abertosproximos');
    $this->get('outras/semretorno', 'OrcamentoController@diasSemRetorno')->name('semretorno');

    //Cadastro em modal
    Route::post('/orcamentos/cliente/cadastraModal', 'ClienteController@cadastraModal')->name('orcamentoCliCriaModal');

    //Resumos
    $this->get('resumo/semanal', 'AppController@semanal')->name('resumoSemanal');
    $this->get('resumo/mensal/{id}', 'AppController@mensal')->name('resumoMensal');
    $this->get('orcamento/mensal/{id}', 'AppController@orcamentoMensal')->name('orcamentoMensal');

    //Rotas padrões
    Route::resource('/clientes', 'ClienteController');
    Route::resource('/contatos', 'ContatoController');
    Route::resource('/eventos', 'EventoController');
    Route::resource('/orcamentos', 'OrcamentoController');
    Route::resource('/cadastro/conheceus', 'ConheceuController');
    Route::resource('/cadastro/meiocontatos', 'MeioContatoController');
    Route::resource('/cadastro/tipoeventos', 'TipoEventoController');
    Route::resource('/cadastro/qtdconvidados', 'QtdConvidadoController');
    Route::resource('/cadastro/qtdfotos', 'QtdFotoController');
    Route::resource('/cadastro/tipofotos', 'TipoFotoController');
    Route::resource('/cadastro/tipocancelamentos', 'TipoCancelamentoController');
    Route::resource('/cadastro/opcaos', 'OpcaoController');
    Route::resource('/cadastro/metas', 'MetaController');

});

Route::get('/home', 'AppController@home')->name('home');
Route::get('/', 'AppController@index')->name('login');

Auth::routes();