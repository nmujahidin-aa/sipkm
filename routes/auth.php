<?php

use Illuminate\Support\Facades\Route;

Route::group(["as"=>"login.", "prefix"=>"login"], function(){
    Route::get("/", "LoginController@index")->name("index");
    Route::post("/", "LoginController@post")->name("post");
});
Route::group(["as"=>"register.", "prefix"=>"register"], function(){
    Route::get("/", "RegisterController@index")->name("index");
    Route::post("/", "RegisterController@post")->name("post");
});

Route::get("/logout", "LogoutController@post")->name("logout");
