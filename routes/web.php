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


// API
Route::get('api/slike', [
	'as' => 'slike',
	'uses' => 'SlikeController@slike'
]);

Route::get('api/slika/{id}', [
	'as' => 'slika',
	'uses' => 'SlikeController@slika'
]);

Route::get('api/slike/{od}/{do}',[
	'as' => 'postiJSON',
	'uses' => 'SlikeController@postiJSON'
])->where('od', '[0-9]+')->where('do', '[0-9]+');

Route::get('api/vote/{id}',[
	'as' => 'vote',
	'uses' => 'SlikeController@vote'
])->where('id', '[0-9]+');

Route::get('api/downvote/{id}',[
	'as' => 'downvote',
	'uses' => 'SlikeController@downvote'
])->where('id', '[0-9]+');


Route::get('add/{num}/posts',[
	'as' => 'faker',
	'uses' => 'SlikeController@faker'
]);

Route::get('api/uporabnik', 'UserController@uporabnikApi');


Auth::routes();


Route::get('home',[
	'as' => 'home',
	'uses' => 'HomeController@home'
]);

Route::get('/',[
	'as' => 'domov',
	'uses' => 'HomeController@domov'
]);


Route::get('login/{service}',[
	'as' => 'login-service',
	'uses' => 'Auth\SocialLoginController@redirect'
]);

Route::get('login/{service}/callback',[
	'as' => 'login-service-callback',
	'uses' => 'Auth\SocialLoginController@callback'
]);


Route::get('meme/{id}',[
	'as' => 'meme',
	'uses' => 'HomeController@getMeme'
])->where('id', '[0-9]+');


// PROFIL
Route::get('uporabnik/{name}',[
	'as' => 'profil',
	'uses' => 'UserController@profilGet'
]);

Route::get('uporabnik/{name}/liked',[
	'as' => 'profil-lied',
	'uses' => 'UserController@profilGetLiked'
]);

Route::get('uporabnik/{name}/disliked',[
	'as' => 'profil-dislied',
	'uses' => 'UserController@profilGetDisliked'
]);


// UREDI PROFIL
Route::get('profil/uredi',[
	'as' => 'profil-uredi',
	'uses' => 'UserController@profilUrediGet'
]);

Route::post('profil/uredi',[
	'uses' => 'UserController@profilUrediPost'
]);

Route::post('profil/uredi/profilka',[
	'uses' => 'UserController@profilUpdateProfilka'
]);


// DODAJ MEME
Route::get('meme/dodaj',[
	'as' => 'meme-dodaj',
	'uses' => 'SlikeController@dodajGet'
]);

Route::post('meme/dodaj',[
	'as' => 'meme-dodaj-post',
	'uses' => 'SlikeController@dodajPost'
]);


// USTVARI MEME
Route::get('meme/ustvari',[
	'as' => 'meme-ustvari',
	'uses' => 'SlikeController@ustvariGet'
]);

Route::post('meme/ustvari',[
	'as' => 'meme-ustvari-post',
	'uses' => 'SlikeController@ustvariPost'
]);


// IZBRIŠI MEME
Route::get('meme/{id}/delete',[
	'as' => 'meme-delete',
	'uses' => 'SlikeController@memeDelete'
])->where('id', '[0-9]+');


// GLASOVANJE
Route::post('meme/{id}/upvote',[
	'as' => 'post-upvote',
	'uses' => 'SlikeController@postUpvote'
]);

Route::post('meme/{id}/downvote',[
	'as' => 'post-downvote',
	'uses' => 'SlikeController@postDownvote'
]);

// KOMENTARJI
Route::post('comment/{id}/add',[
	'as' => 'add-comment',
	'uses' => 'CommentsController@addComment'
]);

Route::get('komentarji/{id}',[
	'as' => 'komentarji-json',
	'uses' => 'CommentsController@komentarjiJSON'
]);
