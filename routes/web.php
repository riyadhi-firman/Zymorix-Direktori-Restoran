<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RestoranController;

Route::get('/', [RestoranController::class, 'home']);

Route::get('/restoran', [RestoranController::class, 'restoranIndex']);
Route::get('/restoran/{id}', [RestoranController::class, 'restoranShow']);

Route::get('/menu', [RestoranController::class, 'menuIndex']);
Route::get('/menu/{id}', [RestoranController::class, 'menuShow']);
