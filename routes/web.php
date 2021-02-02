<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// default
Route::get('/', 'usuariosController@index');

//------------------------------------------------------------
// usuario - login
Route::get('/usuario_frm_login', 'usuariosController@frmLogin');
Route::post('/usuario_executar_login', 'usuariosController@executarLogin');

//------------------------------------------------------------
// usuário - logout
Route::get('/usuario_logout', 'usuariosController@logout');

//------------------------------------------------------------
// usuario - recuperar senha
Route::get('/usuario_frm_recuperar_senha', 'usuariosController@frmRecuperarSenha');
Route::post('/usuario_executar_recuperar_senha', 'usuariosController@executarRecuperarSenha');
Route::get('/usuario_email_enviado', 'usuariosController@emailEnviado');

//------------------------------------------------------------
// usuario - nova conta
Route::get('/usuario_frm_criar_conta', 'usuariosController@frmCriarNovaConta');
Route::post('/usuario_executar_criar_conta', 'usuariosController@executarCriarNovaConta');

//------------------------------------------------------------
// interior da aplicação
Route::get('/aplicacao_index', 'aplicacaoController@apresentarPaginaInicial');