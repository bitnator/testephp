<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/', App\Http\Controllers\UserController::class);
// Tive que criar essas rotas extras porque na última versão algumas rotas do resource estão bugadas
Route::get('/edit_user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editScreen');
Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delete');
Route::post('/update_user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
