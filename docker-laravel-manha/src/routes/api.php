<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\ExploradorController;

Route::post('/exploradores', [ExploradorController::class, 'store']);
Route::put('/exploradores/{id}', [ExploradorController::class, 'update']);
Route::post('/exploradores/{id}/inventario', [ExploradorController::class, 'addItem']);
Route::post('/exploradores/trocar', [ExploradorController::class, 'trocarItens']);
Route::get('/exploradores/{id}', [ExploradorController::class, 'show']);
