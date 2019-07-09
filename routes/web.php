<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/teste', function(){ return view('emails.remocao_comentario'); });

//FRONT
Route::get('/', 'FrontController@home');
Route::get('/sobre', 'FrontController@sobre');

//LOGIN DE TODOS OS USUARIOS
Route::get('/Logar', 'AlunoController@redirect_login');

//AFILIADO
Route::get('/Afiliado/Registro', 'AfiliadoController@registro');
Route::post('/Afiliado/Registrar', 'AfiliadoController@registrar');
Route::get('/Afiliado/Dashboard', 'AfiliadoController@dashboard');
Route::get('/Afiliado/Cursos', 'AfiliadoController@cursos');

//INSTRUTOR
Route::get('/Instrutor/Login', 'InstrutorController@auth');
Route::post('/Instrutor/Login', 'Auth\LoginController@loginUsers');
Route::get('/Instrutor/Registrar', 'InstrutorController@registrar');
Route::post('/Instrutor/Registro', 'InstrutorController@registro');


Route::get('/Instrutor/Dashboard', function(){ return redirect('/Instrutor/Perfil'); })->middleware('instrutor');

Route::get('/Instrutor/Financeiro', 'InstrutorController@financeiro_busca')->middleware('instrutor');


//Route::get('/Instrutor/Dashboard', 'InstrutorController@dashboard')->middleware('instrutor');
Route::get('/Instrutor/Perfil', 'InstrutorController@perfil')->middleware('instrutor');
Route::post('/Instrutor/Atualiza', 'InstrutorController@atualiza')->middleware('instrutor');
Route::post('/Instrutor/{id}/foto', 'InstrutorController@instrutor_foto')->middleware('instrutor');

Route::get('/Instrutor/Cursos', 'CursoController@listar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Novo', 'CursoController@criar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Criar', 'CursoController@curso_criar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Editar/{id}', 'CursoController@editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Atualiza/{id}', 'CursoController@curso_editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Remover/{id}', 'CursoController@destroy')->middleware('instrutor');

Route::get('/Instrutor/Curso/Modulo/{id}', 'ModuloCursoController@listar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Modulo/Novo/{id}', 'ModuloCursoController@criar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/Criar/{id}', 'ModuloCursoController@modulo_criar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Modulo/Editar/{id}', 'ModuloCursoController@editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/Atualiza/{id}', 'ModuloCursoController@modulo_editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/Deletar/{id}', 'ModuloCursoController@deletar')->middleware('instrutor');

Route::get('/Instrutor/Curso/Modulo/{id}/Aulas', 'AulaController@listar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Modulo/{id}/Nova-Aula', 'AulaController@criar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/{id}/Salvar-Aula', 'AulaController@aula_criar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Modulo/{id}/Editar-Aula/{aula_id}', 'AulaController@editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/{id}/Atualiza-Aula/{aula_id}', 'AulaController@aula_editar')->middleware('instrutor');
Route::post('/Instrutor/Curso/Modulo/Aula/Deletar/{id}', 'AulaController@deletar')->middleware('instrutor');
Route::get('/Instrutor/Curso/Modulo/{id}/Editar-Aula/{aula_id}/Gratis', 'AulaController@gratis')->middleware('instrutor');

Route::get('/Instrutor/Curso/Modulo/Aula/Material/{aula_id}', 'MaterialController@index')->middleware('instrutor');
Route::get('/Instrutor/Material/Novo/{aula_id}', 'MaterialController@criar')->middleware('instrutor');
Route::post('/Instrutor/Material/Criar/{aula_id}', 'MaterialController@insert')->middleware('instrutor');
Route::get('/Instrutor/Material/Editar/{id}', 'MaterialController@editar')->middleware('instrutor');
Route::post('/Instrutor/Material/Atualiza/{id}', 'MaterialController@update')->middleware('instrutor');
Route::post('/Instrutor/Material/Remover/{id}', 'MaterialController@destroy')->middleware('instrutor');


Route::get('/Instrutor/Prova/{curso_id}', 'ProvaController@index_prova')->middleware('instrutor');
Route::get('/Instrutor/Prova/Novo/{curso_id}', 'ProvaController@criar_questao')->middleware('instrutor');
Route::post('/Instrutor/Questao/Criar/{curso_id}', 'ProvaController@insert_questao')->middleware('instrutor');
Route::post('/Instrutor/Questao/Deletar/{id}', 'ProvaController@deletar_questao')->middleware('instrutor');
Route::get('/Instrutor/Questao/Editar/{id}', 'ProvaController@edit_questao')->middleware('instrutor');
Route::post('/Instrutor/Questao/Editar/{id}', 'ProvaController@update_questao')->middleware('instrutor');
Route::get('/Instrutor/Alternativas/{questao_id}', 'ProvaController@index_alternativas')->middleware('instrutor');
Route::post('/Instrutor/Alternativas/{questao_id}', 'ProvaController@update_alternativas')->middleware('instrutor');

Route::get('/Instrutor/Mensagens', 'InstrutorMensagemController@index')->middleware('instrutor');
Route::post('/Instrutor/Mensagens', 'InstrutorMensagemController@insere_mensagem')->middleware('instrutor');

Route::get('/Instrutor/Emails', 'InstrutorMensagemController@newsletter')->middleware('instrutor');

//ALUNO
Route::get('/Aluno/Logar', 'AlunoController@redirect_login');
Route::post('/Aluno/Logar', 'Auth\LoginController@loginUsers');
Route::get('/Aluno/Adicionar', 'AlunoController@create');
Route::post('/Aluno/Adicionar', 'AlunoController@registro');
Route::get('/Aluno/Editar', 'AlunoController@edit')->middleware('aluno');
Route::get('/Aluno/Pedidos', 'AlunoController@pedidos')->middleware('aluno');
Route::post('/Aluno/Editar', 'AlunoController@update')->middleware('aluno');
Route::get('/Aluno/Dashboard', 'AlunoController@dashboard')->middleware('aluno')->name('dash');
Route::get('/Aluno/Mensagem', 'AlunoController@mensagem')->middleware('aluno');
Route::get('/Aluno/Mensagem/{id}', 'AlunoController@mensagens')->middleware('aluno');
Route::post('/Aluno/EnviarMensagem', 'AlunoController@enviarMensagem')->middleware('aluno');
Route::get('/Aluno/Assistir/{curso_id}', 'VideoAulaController@index');
Route::get('/Aluno/Assistir/{curso_id}/{aula_id}', 'VideoAulaController@assistir');
Route::post('/Aluno/MarcarAssistido/{id}', 'UserAulaController@marcarAssistido')->middleware('aluno');
Route::get('/Aluno/Prova/Introducao/{curso_id}', 'VideoAulaController@index_prova');
Route::get('/Aluno/Prova/{curso_id}', 'VideoAulaController@iniciar_prova');
Route::get('/Aluno/FinalizarProva/{curso_id}', 'VideoAulaController@finalizar_prova');

Route::get('/Aluno/Certificados', 'AlunoController@certificados')->middleware('aluno');
Route::get('/Gerar-Certificado/{id}', 'AlunoController@gerar_certificado')->middleware('aluno');


Route::post('/Aluno/Anotacao/{curso_id}', 'VideoAulaController@insert_anotacao');
Route::get('/Aluno/Material/Baixar/{aula_id}', 'VideoAulaController@baixar');

//CURSO
Route::get('/Cursos', 'CursoController@cursos');
/*Route::get('/curso/pagar/{id}', 'CursoController@curso_pagar');*/
Route::get('/Curso/Detalhes/{id}', 'CursoController@curso_detalhes');
Route::post('/Curso/Detalhes/{id}', 'CursoController@curso_rating');
Route::get('/Categoria/{id}', 'CursoController@categoria');
Route::post('/busca', 'CursoController@busca');

Route::get('/Curso/{id}', 'CursoController@link_compartilhado');

//DASHBOARD
Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('admin');
Route::get('/permissao', 'HomeController@permissao')->middleware('admin');

Route::get('/notificacao/{id}', 'NotificacaoController@ler_notificacao')->middleware('admin');

Route::get('/usuarios', 'UsuarioController@index')->middleware('admin');
Route::get('/usuario/adicionar', 'UsuarioController@create')->middleware('admin');
Route::post('/usuario/adicionar', 'UsuarioController@insert')->middleware('admin');
Route::get('/usuario/editar/{id}', 'UsuarioController@edit')->middleware('admin');
Route::get('/usuario/ver/{id}', 'UsuarioController@ver')->middleware('admin');
Route::post('/usuario/editar/{id}', 'UsuarioController@update')->middleware('admin');
Route::post('/usuario/remover/{id}', 'UsuarioController@destroy')->middleware('admin');
Route::get('/usuario/enviar-acesso/{id}', 'UsuarioController@enviar_acesso')->middleware('admin');
Route::get('/usuario/definir-senha/{email}/{id}/{token}', 'UsuarioController@definir_senha')->middleware('admin');
Route::post('/usuario/definir-senha/{email}/{id}/{token}', 'UsuarioController@definir_senha_update')->middleware('admin');

Route::get('/acessos', 'AcessoController@index')->middleware('admin');
Route::get('/acesso/adicionar', 'AcessoController@create')->middleware('admin');
Route::post('/acesso/adicionar', 'AcessoController@insert')->middleware('admin');
Route::get('/acesso/editar/{id}', 'AcessoController@edit')->middleware('admin');
Route::post('/acesso/editar/{id}', 'AcessoController@update')->middleware('admin');
Route::post('/acesso/remover/{id}', 'AcessoController@destroy')->middleware('admin');

Route::get('/contatos', 'UsuarioController@contatos')->middleware('admin');
Route::post('/contatos', 'UsuarioController@contatos_busca')->middleware('admin');
Route::post('/contato/{id}/foto', 'UsuarioController@contato_foto')->middleware('admin');
Route::post('/contato/{id}', 'UsuarioController@contato_update')->middleware('admin');

Route::get('/mensagens', 'MensagemController@index')->middleware('admin');
Route::get('/mensagens/{id}/{url}', 'MensagemController@canal')->middleware('admin');
Route::post('/mensagens/{id}/{url}', 'MensagemController@canal_insere_mensagem')->middleware('admin');

Route::get('/categorias', 'CategoriaController@index')->middleware('admin');
Route::get('/categoria/adicionar', 'CategoriaController@create')->middleware('admin');
Route::post('/categoria/adicionar', 'CategoriaController@insert')->middleware('admin');
Route::get('/categoria/editar/{id}', 'CategoriaController@edit')->middleware('admin');
Route::post('/categoria/editar/{id}', 'CategoriaController@update')->middleware('admin');
Route::post('/categoria/remover/{id}', 'CategoriaController@destroy')->middleware('admin');


Route::get('/comentarios', 'ComentarioController@index')->middleware('admin');
Route::post('/comentario/remover/{id}', 'ComentarioController@destroy')->middleware('admin');


Route::get('/cursos', 'CursoController@index')->middleware('admin');
Route::get('/curso/habilitar/{id}', 'CursoController@habiitar')->middleware('admin');

Route::post('/carrinho', 'CarrinhoController@add_cart');
Route::post('/carrinho/remove_item', 'CarrinhoController@remove_item');
Route::post('/carrinho/desconto', 'CarrinhoController@desconto');
Route::get('/carrinho', 'CarrinhoController@get_cart');
Route::get('/carrinho/limpar', 'CarrinhoController@destroy');
Route::post('/moip', 'CarrinhoController@moip');

Route::get('/Afiliado/{cod}', 'AfiliadoController@calc_cod');
Route::post('/newsletter', 'FrontController@newsletter');

Route::post('/newsletter/remover/{id}', 'FrontController@destroy_newsletter')->middleware('admin');
Route::post('/enviar_mensagem_email', 'UsuarioController@enviar_mensagem_email')->middleware('admin');

Route::get('/verificar-certificado', 'FrontController@index_verificar_certificado');
Route::post('/verificar', 'FrontController@verificar_certificado');

Route::get('/newsletter_report', 'UsuarioController@newsletter');


Route::get('/pagamento', 'PagamentoController@pagamento');
Route::post('/pagamento', 'PagamentoController@pagar');
Route::post('/Pagamento/Webhook', 'PagamentoController@retornoMoip');
Route::get('/Pagamento/Criar-Webhook', 'PagamentoController@criarWebhook')->middleware('admin');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});