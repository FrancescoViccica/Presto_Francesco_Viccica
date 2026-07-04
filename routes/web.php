<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;

// Pagina principale del sito
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');

Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');

Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');

Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');

