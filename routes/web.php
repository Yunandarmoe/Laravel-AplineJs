<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [StudentController::class, 'index'])->name('form');
Route::post('/form', [StudentController::class, 'store'])->name('form');
Route::get('/detail', [StudentController::class, 'show'])->name('detail');




