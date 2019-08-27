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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//update user
Route::get('/user/configuration', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

//perfil de usuario
Route::get('/profile/{id}', 'UserController@profile')->name('user.profile');

//buscador y listado de usuarios
Route::get('/users/{search?}', 'UserController@index')->name('user.index');


//subir imagen
Route::get('/create-image', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');

//listar imagenes (inicio)
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');

//detalle de imagen
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');

//eliminar imagen
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');

//actualizar imagen
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

//publicar un comentario (guardar comentario)
Route::post('/comment/save', 'CommentController@save')->name('comment.save');

//eliminar comentario
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//darle like y dislike a publicacion
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');

//mostrar imagenes favoritas
Route::get('/likes', 'LikeController@index')->name('likes');
