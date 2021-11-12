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
Route::group(['prefix' => 'login',  'module' => 'login', 'namespace' => 'App\Modules\Login\Controllers'], function () {
    
    Route::get('dashboard',  'LoginController@dashboard');
    Route::get('logout',  'LoginController@logout');
    Route::post('logsearch',  'LoginController@login');
});

Route::get('/',  'App\Modules\Login\Controllers\LoginController@index');