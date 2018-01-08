<?php

use Illuminate\Http\Request;

Route::get('/uporabnik/{name}/nalozeno', 'UserController@nalozeno');
Route::get('/uporabnik/{name}', 'UserController@uporabnik');
