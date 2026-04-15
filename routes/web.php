<?php

use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [CrudUserController::class, 'login'])->name('login');
Route::post('/login', [CrudUserController::class, 'storeLogin'])->name('login.store');
Route::get('/register', [CrudUserController::class, 'register'])->name('register');
Route::post('/register', [CrudUserController::class, 'storeRegister'])->name('register.store');
Route::get('/list', [CrudUserController::class, 'list'])->name('users.list');
Route::get('/view', [CrudUserController::class, 'view'])->name('users.view');
Route::get('/update', [CrudUserController::class, 'edit'])->name('users.edit');
Route::post('/update', [CrudUserController::class, 'storeUpdate'])->name('users.update');
Route::get('/delete', [CrudUserController::class, 'delete'])->name('users.delete');
Route::get('/logout', [CrudUserController::class, 'logout'])->name('logout');
