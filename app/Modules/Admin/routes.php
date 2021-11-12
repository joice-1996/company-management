<?php
/*
|--------------------------------------------------------------------------
| ModuleOne Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the ModuleOne module have to go in here. Make sure
| to change the namespace in case you decide to change the
| namespace/structure of controllers.
|
 */
Route::group(['prefix' => 'admin',  'module' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers'], function () {
    //Route::get('user_list',  'AdminController@');
    Route::get('product',  'AdminController@index');
    Route::view('','AdminController@');
    Route::post('productadding',  'AdminController@create');
    Route::get('product/{id}',  'AdminController@productdelete');

    Route::get('quotation','AdminController@Quotationadd');
    Route::post('quotationadding','AdminController@addingquotation');
    Route::get('quotation/{id}',  'AdminController@invoice');

    Route::post('invoice_adding','AdminController@invoiceadd');
    Route::post('invoice_pdf','AdminController@pdf_invoice');

    //Route::get('country/{id}','AdminController@dropproduct');


    Route::get('clientfullview','AdminController@client');
    Route::get('client/{id}','AdminController@');
    Route::get('clientdetails','AdminController@clientdetails');


    Route::get('cl','AdminController@cli');
    Route::get('c','AdminController@Qu');

    Route::post('pdf','AdminController@quotation_pdf');
    Route::post('ur','AdminController@pd');



});









