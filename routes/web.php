<?php


use App\Http\Controllers\LoginReg;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TasklistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TasklistController::class, 'lists'] )->name('lists');
Route::get('/createList', [TasklistController::class, 'createList'])->name('createList');
Route::post('/createList', [TasklistController::class, 'createListPost'])->name('createList.post');

Route::get('/{id}/editList', [TasklistController::class, 'editList'])->name('editList');
Route::put('/{id}/editList', [TasklistController::class, 'editListPost'])->name('editList.post');

// Route::any('/', [TasklistController::class, 'header']);
// Route::any('/', [TaskController::class]);
// Route::any('/', [LoginReg::class]);


Route::get('/{id}/list', [TaskController::class, 'home'])->name('list');
Route::get('/{id}/{sort?}/list', [TaskController::class, 'homeSort'])->name('listSort');

Route::get('/login', [LoginReg::class, 'login'])->name('login');
Route::post('/login', [LoginReg::class, 'loginPost'])->name('login.post');

Route::get('/reg', [LoginReg::class, 'reg'])->name('reg');
Route::post('/reg', [LoginReg::class, 'regPost'])->name('reg.post');
Route::get('/logout', [LoginReg::class, 'logout'])->name('logout');

Route::get('/{id}/create', [TaskController::class, 'create'])->name('create');
Route::post('/create', [TaskController::class, 'createPost'])->name('create.post');
Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
Route::put('/{id}/edit', [TaskController::class, 'editPost'])->name('edit.post');

Route::delete('/{id}/destroy', [TaskController::class, 'destroy'])->name('destroy');

Route::get('/{id}/destroyList', [TasklistController::class, 'destroyList'])->name('destroyList');
Route::delete('/{id}/destroyListpost', [TaskListController::class, 'destroyListpost'])->name('destroyListpost');



