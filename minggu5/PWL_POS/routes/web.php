<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Controller;
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

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

//====== Jobsheet 4 =======
//praktikkum 2.6 no.5
Route::get('/user/tambah', [UserController::class, 'tambah']);

//praktikkum 2.6 no.8
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

//praktikkum 2.6 no. 12
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

//praktikkum 2.6 no. 15
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

//praktikkum 2.6 no. 18
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//============== Jobsheet 5 =============
// praktikkum 3 nomer 1
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);

//============= tugas praktikkum =================
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');

Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');

Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

Route::resource('kategori', KategoriController::class);

Route::resource('kategori', KategoriController::class);
Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');