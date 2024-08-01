<?php

use App\Http\Controllers\PetstoreController;
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

Route::get('/', [PetstoreController::class, 'index']);
Route::get('/pet/create', [PetstoreController::class, 'create']);
Route::get('/pet/{id}', [PetstoreController::class, 'show']);
Route::get('/pet/edit/{id}', [PetstoreController::class, 'edit']);
Route::post('/pet', [PetstoreController::class, 'store']);
Route::put('/pet/{id}', [PetstoreController::class, 'update']);
Route::delete('/pet/{id}', [PetstoreController::class, 'destroy']);
