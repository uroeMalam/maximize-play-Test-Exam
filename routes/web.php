<?php

use App\Http\Controllers\MlmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MlmController::class, 'index'])->name('route_agama');
Route::get('/DataTable', [MlmController::class, 'DataTable'])->name('route_DataTable');
Route::get('/tambah', [MlmController::class, 'create'])->name('route_create');
Route::post('/insert', [MlmController::class, 'store'])->name('route_store');
Route::get('/edit/{id}', [MlmController::class, 'edit'])->name('route_edit');
Route::get('/show/{id}', [MlmController::class, 'show'])->name('route_show');
Route::post('/update', [MlmController::class, 'update'])->name('route_update');
Route::delete('/delete', [MlmController::class, 'destroy'])->name('route_destroy');
Route::get('/getDataByID/{id}', [MlmController::class, 'getDataByID'])->name('route_getID');

    
