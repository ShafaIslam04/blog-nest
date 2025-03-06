<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[UserController::class,'register'])->name('register.index');
Route::post('/register',[UserController::class,'store'])->name('register');
// Route::post('/dashboard',[PostController::class,'store'])->name('dashboard.store');
// Route::get('/dashboard/post',[PostController::class,'create'])->name('dashboard.post');

Route::get('/blogs',[PostController::class,'show'])->name('blogs.show');
Route::get('/blogs/{post}',[PostController::class,'detail'])->name('blogs.detail');

Route::post('/blogs/{post}/post',[CommentController::class,'store'])->name('comment.store');
Route::get('/blogs/{post}/post',[CommentController::class,'show'])->name('comment.show');
Route::post('/blogs/{post}/like',[LikeController::class,'store'])->name('posts.store');
// Route::get('/dashboard/filtered', [PostController::class, 'filter'])->name('dashboard.filter');
Route::get('/filteredPage',[PostController::class,'filter'])->name('filtered.filter');
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','role:author,admin'])->group(function(){
Route::post('/blogs',[PostController::class,'store'])->name('blogs.store');
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::put('/blogs/{post}/update',[PostController::class,'update'])->name('blogs.update');
Route::delete('/blogs/{post}/destroy',[PostController::class,'destroy'])->name('posts.destroy');
});

Route::middleware(['auth','role:admin'])->group(function(){
Route::get('/show',[RegisteredUserController::class,'show'])->name('show.show');
Route::get('/table/{user}/edit',[RegisteredUserController::class,'edit'])->name('show.edit');
Route::put('table/{user}/update',[RegisteredUserController::class,'updates'])->name('show.update');
Route::delete('show/{user}/destroy',[RegisteredUserController::class,'destroy'])->name('table.destroy');
});


require __DIR__.'/auth.php';
