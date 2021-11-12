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
Route::group(['prefix' => 'client',  'module' => 'client', 'namespace' => 'App\Modules\Client\Controllers'], function () {
    
    Route::get('/',  'ClientController@index');
    Route::post('client_details_search', 'ClientController@index');
    Route::post('add_client','ClientController@addClient');
    Route::get('get_product','ClientController@get_product');
    Route::post('client_export','ClientController@client_export');
    Route::post('client_delete/{id}','ClientController@client_delete');
    Route::post('client_deactivate/{id}','ClientController@client_deactivate');
    Route::post('client_edit_view/{id}','ClientController@client_edit_view');
    Route::post('client_activate/{id}','ClientController@client_activate');
    Route::post('edit_client','ClientController@edit_client');
    //Route::post('filter','ClientController@filter_data');
    Route::post('client_details','ClientController@ client_details');
   // Route::get('client_view','ClientController@client_view');
   // Route::get('registration',  'UserController@registrationView');
});
