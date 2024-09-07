<?php

use App\Http\Controllers\ExListController;
use Illuminate\Support\Facades\Route;


// BASIC CRUD
Route::get('/', [ExListController::class, 'index']);
Route::post('/store', [ExListController::class, 'store']);
Route::get('/edit/{id}', [ExListController::class, 'edit']);
Route::put('/update/{id}', [ExListController::class, 'update']);
Route::delete('/delete/{id}', [ExListController::class, 'destroy']);
