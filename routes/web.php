<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('index_produto_teste'); ///corigir as rotas
})->name('home');

Route::get('/produtos/teste', 'App\Http\Controllers\home\produtos@index')->name('index_produto_teste');

Route::prefix('admin/')->namespace('App\Http\Controllers')->middleware('check.admin')->group(function() {
    /**
    * Rotas usuario Admin
    */
    Route::any('usuario', 'UsuarioController@index')->name('index_usuario');
    Route::get('usuario/create', 'UsuarioController@create')->name('create_usuario');
    Route::post('usuario/create', 'UsuarioController@store')->name('store_usuario');
    Route::post('usuario/search', 'UsuarioController@search')->name('search_usuario');
    Route::get('usuario/{id}', 'UsuarioController@edit')->name('edit_usuario');
    Route::post('usuario/{id}', 'UsuarioController@update')->name('update_usuario');
    Route::delete('usuario/{id}', 'UsuarioController@delete')->name('delete_usuario');

    /**
     * Rotas Produtos Admin 
     */
    Route::get('produto/create', 'ProdutosController@create')->name('create_produto');
    Route::post('produto/create', 'ProdutosController@store')->name('store_produto');
    Route::get('produto/{id}', 'ProdutosController@edit')->name('edit_produto');
    Route::put('produto/{id}', 'ProdutosController@update')->name('update_produto');
    Route::delete('produto/{id}', 'ProdutosController@delete')->name('delete_produto');
    Route::any('produto', 'ProdutosController@index')->name('index_produto');

    /**
     * Routes Pedidos Admin
     */
    
    Route::get('pedidos/pagos', 'PedidosProdutosController@listarPedidosPagos')->name('listarPedididosPagos');
    Route::get('pedidos/cancelados', 'PedidosProdutosController@listarPedidosCancelados')->name('listarPedididosCancelados');
    Route::any('pedido/{status?}', 'PedidosProdutosController@index')->name('index_pedido');
    Route::get('pedido/{id}/status/{status}', 'PedidosProdutosController@update')->name('update_pedido');
    Route::post('pedido/search', 'PedidosProdutosController@search')->name('search_pedido');
    Route::delete('pedido/delete/{id}', 'PedidosProdutosController@delete')->name('delete_pedido');
    Route::get('pedido/{id}/detalhes', 'PedidosProdutosController@show')->name('show_pedido');
    Route::get('pedido/usuario/{id}', 'PedidosProdutosController@produtosPedidos')->name('show_usuarioPedido');
    


});


/**
 *  Register e Login
 */
Route::post('cadastrar', 'App\Http\Controllers\RegistrarController@store')->name('cadastrar_usuario');
Route::get('cadastrar-se', 'App\Http\Controllers\RegistrarController@index')->name('registrar');
Route::get('login', 'App\Http\Controllers\EntrarController@index')->name('login');
Route::post('login', 'App\Http\Controllers\EntrarController@logar')->name('login');

/**
 * Rotas Produto
 */

Route::post('produto/search', 'App\Http\Controllers\ProdutosController@search')->name('search_produto');
Route::get('produto/adicionar-carrinho',  'App\Http\Controllers\home\ProdutosPedidosController@adicionarAoCarrinho')->name('adicionar_produto_carrinho')->middleware('auth');
Route::get('produtos/carrinho',  'App\Http\Controllers\home\ProdutosPedidosController@verCarrinho')->name('ver_carrinho')->middleware('auth'); 
Route::get('store/produtos-pedidios',  'App\Http\Controllers\home\ProdutosPedidosController@salvarPedido')->name('store_pedido_produto')->middleware('auth'); 




/**
 * Rotas Pedidos
 */
Route::get('pedido/usuario', 'App\Http\Controllers\PedidosProdutosController@create')->name('create_pedido'); 
Route::post('pedido/create/{idp}', 'App\Http\Controllers\PedidosProdutosController@store')->name('store_pedido')->middleware('auth');







