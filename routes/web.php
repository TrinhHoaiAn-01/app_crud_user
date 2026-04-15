<?php

use App\Http\Controllers\CrudUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [CrudUserController::class, 'register'])->name('register');
Route::post('/register', [CrudUserController::class, 'storeRegister'])->name('register.store');
