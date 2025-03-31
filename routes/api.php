<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController; // import controller PostsController
use App\Http\Controllers\CommentsController; // import controller CommentsController
use App\Http\Controllers\LikesController; // import controller LikesController
use App\Http\Controllers\MessagesController; // import controller MessagesController

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () { // prefix untuk menentukan versi API
    // Menghandle Post
    Route::prefix('posts')->group(function () {  
        Route::get('/', [PostsController::class, 'index']); // mengambil semua data
        Route::post('/', [PostsController::class, 'store']); // menyimpan data
        Route::get('{id}', [PostsController::class, 'show']); // mengambil data berdasarkan id
        Route::put('{id}', [PostsController::class, 'update']); // mengupdate data berdasarkan id
        Route::delete('{id}', [PostsController::class, 'destroy']); // menghapus data berdasarkan id
    }); 

    // Menghandle Comment
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentsController::class, 'store']); // Simpan komentar baru
        Route::delete('{id}', [CommentsController::class, 'destroy']); // Menghapus komentar
    });

    // Menghandle Likes
    Route::prefix('likes')->group(function () {
        Route::post('/', [LikesController::class,'store']); // Simpan like baru
        Route::delete('{id}', [LikesController::class, 'destroy']); // Menghapus like
    });


    // Menghandle Messages
    Route::prefix('messages')->group(function () {
        Route::post('/', [MessagesController::class,'store']); // kirim pesan
        Route::get('{id}', [MessagesController::class, 'show']); // lihat detail pesan
        Route::delete('{id}', [MessagesController::class, 'destroy']); // Menghapus pesan
    });
});