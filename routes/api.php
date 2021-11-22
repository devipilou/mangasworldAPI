<?php

use Illuminate\Http\Request;
//routes générales CRUD--------------------------------------------------
Route::group(['middleware' => 'auth:api'], function(){
  Route::post('/manga', 'MangaController@store');
  Route::put('/manga', 'MangaController@update');
  Route::delete('/manga/{id}', 'MangaController@delete');
  
  Route::get('/dessinateur', 'DessinateurController@index');
  Route::post('/dessinateur', 'DessinateurController@store');
  Route::put('/dessinateur', 'DessinateurController@update');
  Route::delete('/dessinateur/{id}', 'DessinateurController@delete');
  
  Route::get('/scenariste', 'ScenaristeController@index');
  
  
  Route::post('/commentaire', 'CommentaireController@store');
  Route::put('/commentaire', 'CommentaireController@update');
  Route::delete('/commentaire/{id}', 'CommentaireController@delete');
  
  Route::get('/lecteur/{id}', 'ProfilController@show');
  Route::put('/lecteur', 'ProfilController@update');
  
  Route::get('logout', 'Auth\LoginController@logout');
});
Route::get('/commentaire/manga/{id}','MangaController@show');
Route::get('/manga', 'MangaController@index');
Route::get('/manga/{id}', 'MangaController@show');
Route::get('/manga/genre/{id}', 'MangaController@getMangasGenre');
Route::get('/genre', 'GenreController@index');
//route alternative pour lister par manga d'un même genre
// Route::get('/manga/genre/{id}', 'GenreController@getMangasGenre');
Route::get('/commentaire', 'CommentaireController@index');
Route::get('/commentaire/{id}', 'CommentaireController@show');


//routes Auth et Securité -----------------------------------------------
Route::post('login', 'Auth\LoginController@login');

Route::post('register', 'Auth\RegisterController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});






