<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add-templates',[
    'uses' => 'TemplateController@store']);

Route::get('template',[
    'uses'=> 'TemplateController@getTemplateById'
]);

Route::get('allTemplates',[
    'uses'=>'TemplateController@getAllTemplates'
]);

Route::post('templateGroups',[
    'uses'=>'TemplateGroupController@save'

]);

Route::get('searchOptions', [
    'uses'=>'TemplateGroupController@templateSearchOptions'
]);

Route::put('/template/{id}',[
    'uses'=> 'TemplateController@edit']);

Route::delete('templateGroups/{id}',[
    'uses' => 'TemplateGroupController@delete'
]);

Route::get('templateGroups',[
    'uses'=>'TemplateGroupController@index'
]);


//Route::resource('templates','TemplateController');