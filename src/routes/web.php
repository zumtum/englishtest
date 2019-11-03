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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);
    Route::resource('/quiz', 'QuizController', ['as'=>'admin']);
    Route::resource('/question', 'QuestionController', ['as'=>'admin']);
    Route::resource('/assignment', 'AssignmentController', ['as'=>'admin']);
    Route::get('/assignment/{assignment}/send', 'AssignmentController@send', ['as'=>'admin'])->name('admin.assignment.send');
    Route::group(['prefix' => 'user_management', 'namespace' => 'UserManagement', 'middleware' => ['auth']], function () {
        Route::resource('/user', 'UserController', ['as' => 'admin.user_management']);
    });
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();