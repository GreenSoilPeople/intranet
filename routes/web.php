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

Route::any('/', 'EmployeeController@index');

Route::get('create','EmployeeController@create');


Route::put('employee/store','EmployeeController@store');

Route::match(['get', 'post'],'list', 'EmployeeController@list');

Route::get('employee/{uid}/edit', 'EmployeeController@edit');

Route::patch('employee/{uid}/update', 'EmployeeController@update');

Route::get('employee/{uid}/delete', 'EmployeeController@delete');

Route::get('employee/deleted', 'EmployeeController@deleted');

Route::get('employee/{uid}/toggleStatus', 'EmployeeController@toggleStatus');
Route::get('/admin', 'AdminController@index');
Auth::routes();

Route::get('/home', 'EmployeeController@index');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::match(['get', 'post'],'photo', 'PhotoController@index');

Route::get('/photo/{id}', 'PhotoController@show');

Route::get('department', 'DepartmentController@index');

Route::match(['get', 'post'], 'department/{id}/update', 'DepartmentController@update');

Route::post('department/store', 'DepartmentController@store');

Route::get('department/{id}/delete', 'DepartmentController@delete');

//File

Route::get('/docs', 'DocController@index');

Route::get('docs/data', [
    'as' => 'docs.data',
    'uses' => 'DocController@treeData',
]);



//Locale

