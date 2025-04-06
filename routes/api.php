<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPosts;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserPosts::class)->group(function () {
    Route::get('/from/{begin}/to/{end}', 'RequestMessageRange');
    Route::get('/getnewestposts', 'GetNewestPosts');
    Route::post('/post', 'CreateMessage');
    Route::get('/search/{id}', 'SearchForMessage');
    Route::get('/newestid', 'GetNewestMessageId');
});






