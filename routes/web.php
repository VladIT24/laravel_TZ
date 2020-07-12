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
    return view('welcome');
});

Route::get('/add_customer/{name}/{cnp}','CustomerController@add');

Route::get('/add_transaction/{customer_id}/{amount}','TransactionController@add');

Route::get('update_transaction/{transaction_id}/{amount}', 'TransactionController@update');

Route::get('delete_transaction/{transaction_id}','TransactionController@delete');

Route::group(['prefix'=>'transaction'],function(){

    Route::get('/{customer_id}/{transaction_id}', 'TransactionController@get');

    Route::get('/show_by_filter/{customer_id}/{amount}/{date}/{offset}/{limit}', 'TransactionController@showByFilter');

});


