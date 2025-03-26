<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

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

});