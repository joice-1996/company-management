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
Route::group(['prefix' => 'user',  'module' => 'user', 'namespace' => 'App\Modules\User\Controllers'], function () {
    Route::get('user_list',  'UserController@index');
    Route::get('registration',  'UserController@registrationView');
    Route::post('add',  'UserController@add');
    Route::post('licence',  'UserController@addlicence');
    Route::post('perlicence',  'UserController@prelicence');
    Route::get('licence_view',  'UserController@licence_view');
    Route::get('delete/{id}','UserController@delete');
    Route::get('edit/{id}',  'UserController@edit');
    Route::get('licence_log',  'UserController@licence_log');
    Route::post('user_search','UserController@registrationView');
    Route::post('user_export','UserController@user_export');
   // Route::post('filter','UserController@filter_data');
});
