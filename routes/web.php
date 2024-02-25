<?php

use App\Http\Controllers\FunkosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('funkos.index');
});



Route::group(['prefix' => 'funkos'], function () {

    Route::get('/', [FunkosController::class, 'index'])->name('funkos.index');

    Route::get('/create', [FunkosController::class, 'create'])->name('funkos.create')->middleware(['auth', 'admin']);

    Route::post('/', [FunkosController::class, 'store'])->name('funkos.store')->middleware(['auth', 'admin']);

    Route::get('/{funko}', [FunkosController::class, 'show'])->name('funkos.show');

    Route::get('/{funko}/edit', [FunkosController::class, 'edit'])->name('funkos.edit')->middleware(['auth', 'admin']);

    Route::put('/{funko}', [FunkosController::class, 'update'])->name('funkos.update')->middleware(['auth', 'admin']);

    Route::delete('/{funko}', [FunkosController::class, 'destroy'])->name('funkos.destroy')->middleware(['auth', 'admin']);

    Route::get('/{funko}/edit-image', [FunkosController::class, 'editImage'])->name('funkos.editImage')->middleware(['auth', 'admin']);

    Route::patch('/{funko}/edit-image', [FunkosController::class, 'updateImage'])->name('funkos.updateImage')->middleware(['auth', 'admin']);

});

Route::group(['prefix' => 'categorias'], function () {

    Route::get('/', [CategoriasController::class, 'index'])->name('categorias.index')->middleware(['auth', 'admin']);

    Route::get('/create', [CategoriasController::class, 'create'])->name('categorias.create')->middleware(['auth', 'admin']);

    Route::post('/', [CategoriasController::class, 'store'])->name('categorias.store')->middleware(['auth', 'admin']);

    Route::get('/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit')->middleware(['auth', 'admin']);

    Route::put('/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update')->middleware(['auth', 'admin']);

    Route::delete('/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy')->middleware(['auth', 'admin']);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
