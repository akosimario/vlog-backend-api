<?php

use App\Http\Controllers\Auth\registerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Comment\commentController;
use App\Http\Controllers\Post\postController;
use App\Http\Controllers\Profile\profileController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [registerController::class, 'authRegister']);
Route::post('/login', [loginController::class, 'authLogin']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/posts', [postController::class, 'storeContent']);
    Route::get('/posts', [postController::class, 'fetchContent']);
    Route::put('/posts/{post}', [postController::class, 'updateContent']);
    Route::delete('/posts/{post}', [postController::class, 'destroyContent']);
    Route::get('/posts/{post}/comments',[commentController::class, 'index']);
    Route::post('/posts/{post}/comments', [commentController::class, 'store']);
    Route::post('/comments/{comment}/reply', [commentController::class, 'reply']);
    Route::delete('/comments/{comment}', [commentController::class, 'destroy']);
    Route::get('/profile', [profileController::class, 'show']);
    Route::post('/profile', [profileController::class, 'update']);
});
