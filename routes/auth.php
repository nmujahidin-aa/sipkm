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

Route::group(["as"=>"reset-password.", "prefix"=>"reset-password"], function(){
    Route::get("/", "PasswordResetController@index")->name("index");
    Route::post("/sendValidation", "PasswordResetController@sendValidation")->name("validation");
    Route::get("/{token}", "PasswordResetController@resetPasswordPage")->name("reset-page");
    Route::post("/", "PasswordResetController@resetPassword")->name("reset");
});


Route::get("/logout", "LogoutController@post")->name("logout");
