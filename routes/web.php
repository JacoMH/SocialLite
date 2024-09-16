<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeDislikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('post', PostController::class)->middleware(['auth', 'verified']);

Route::resource('comment', CommentController::class)->middleware(['auth', 'verified']);

Route::resource('like', LikeController::class)->middleware(['auth', 'verified']);

Route::post('like/{postID}/upload',[LikeDislikeController::class, 'upload'])->name('like.upload');

Route::get('/User/{id}', UserController::class, 'index')->name('User.index');

Route::get('/search', function () {
    return view('search');
})->middleware(['auth', 'verified'])->name('search');

Route::get('/search/{Query}', SearchController::class)->middleware(['auth', 'verified'])->name('search.query');


require __DIR__.'/auth.php';
