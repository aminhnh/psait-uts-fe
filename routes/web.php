<?php

use App\Http\Controllers\NilaiController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');

Route::get('nilai/create', [NilaiController::class, 'create'])->name('nilai.create');
Route::post('nilai/store', [NilaiController::class, 'store'])->name('nilai.store');

Route::get('nilai/edit/{nim}/{kode_mk}', [NilaiController::class, 'edit'])->name('nilai.edit');
Route::post('nilai/update/{nim}/{kode_mk}', [NilaiController::class, 'update'])->name('nilai.update');

Route::delete('nilai/{nim}/{kode_mk}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
