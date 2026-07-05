<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;

// Pagina principale del sito
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');

Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');

Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');

Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory')->middleware('auth');

Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware(['auth' ,'isRevisor'])->name('revisor.index');

Route::get('/revisor/verify', [RevisorController::class, 'verify'])->middleware(['auth', 'isRevisor'])->name('revisor.verify');

Route::patch('accept/{article}', [RevisorController::class, 'accept'])->middleware(['auth', 'isRevisor'])->name('accept');

Route::patch('reject/{article}', [RevisorController::class, 'reject'])->middleware(['auth', 'isRevisor'])->name('reject');

Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

Route::get('make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');