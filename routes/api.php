<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController; // import controller PostsController
use App\Http\Controllers\CommentsController; // import controller CommentsController
use App\Http\Controllers\LikesController; // import controller LikesController
use App\Http\Controllers\MessagesController; // import controller MessagesController
use App\Http\Controllers\JWTAuthController; // import controller JWTAuthController
use App\Http\Middleware\JWTMiddleware; // import middleware JWTMiddleware


Route::prefix('v1')->group(function () { // prefix untuk menentukan versi API

    // Menghandle AUth
    Route::post('register', [JWTAuthController::class, 'register']); // register
    Route::post('login', [JWTAuthController::class, 'login']); // login

    // Menghandle Post 
    Route::middleware(JWTMiddleware::class)->prefix('posts')->group(function () {  // tambahkan middleware JWTMiddleware
        Route::get('/', [PostsController::class, 'index']); // mengambil semua data
        Route::post('/', [PostsController::class, 'store']); // menyimpan data
        Route::get('{id}', [PostsController::class, 'show']); // mengambil data berdasarkan id
        Route::put('{id}', [PostsController::class, 'update']); // mengupdate data berdasarkan id
        Route::delete('{id}', [PostsController::class, 'destroy']); // menghapus data berdasarkan id
    }); 

    // Menghandle Comment
    Route::middleware(JWTMiddleware::class)->prefix('comments')->group(function () { // tambahkan middleware JWTMiddleware
        Route::post('/', [CommentsController::class, 'store']); // Simpan komentar baru
        Route::delete('{id}', [CommentsController::class, 'destroy']); // Menghapus komentar
    });

    // Menghandle Likes
    Route::middleware(JWTMiddleware::class)->prefix('likes')->group(function () { // tambahkan middleware JWTMiddleware
        Route::post('/', [LikesController::class,'store']); // Simpan like baru
        Route::delete('{id}', [LikesController::class, 'destroy']); // Menghapus like
    });


    // Menghandle Messages
    Route::middleware(JWTMiddleware::class)->prefix('messages')->group(function () { // tambahkan middleware JWTMiddleware
        Route::post('/', [MessagesController::class,'store']); // kirim pesan
        Route::get('{id}', [MessagesController::class, 'show']); // lihat detail pesan
        Route::get('/getMessages/{user_id}', [MessagesController::class, 'getMessages']); // lihat pesan berdasarkan user id
        Route::delete('{id}', [MessagesController::class, 'destroy']); // Menghapus pesan
    });

});