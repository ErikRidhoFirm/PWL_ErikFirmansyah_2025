<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

// jobsheet 5 revisi 
// praktikkum 2 no 4
Route::get('/', [WelcomeController::class, 'index']);