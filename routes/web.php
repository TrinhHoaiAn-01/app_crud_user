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
Route::get('/logout', [CrudUserController::class, 'logout'])->name('logout');
