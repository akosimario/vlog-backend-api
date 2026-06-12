<?php

use App\Http\Controllers\Auth\registerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Comment\commentController;
use App\Http\Controllers\Post\postController;
use App\Http\Controllers\Profile\profileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [registerController::class, 'authRegister']);
Route::post('/login', [loginController::class, 'authLogin']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/posts/{post}', [postController::class, 'updateContent']);
    Route::delete('/posts/{post}', [postController::class, 'destroyContent']);
    Route::post('/posts/{post}/comments', [commentController::class, 'store']);
    Route::post('/posts', [postController::class, 'storeContent']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    Route::get('/posts', [postController::class, 'fetchContent']);
    Route::get('/profile', [profileController::class, 'show']);
    Route::post('/profile', [profileController::class, 'update']);
});
