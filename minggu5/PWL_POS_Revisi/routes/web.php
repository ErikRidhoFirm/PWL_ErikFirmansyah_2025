<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);

// //====== Jobsheet 4 =======
// //praktikkum 2.6 no.5
// Route::get('/user/tambah', [UserController::class, 'tambah']);

// //praktikkum 2.6 no.8
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// //praktikkum 2.6 no. 12
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// //praktikkum 2.6 no. 15
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// //praktikkum 2.6 no. 18
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// jobsheet 5 revisi 
// praktikkum 2 no 4
Route::get('/', [WelcomeController::class, 'index']);

// jobsheet 5 praktikkum 3 no 3
Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   //menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         //menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  //menamilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);         //menyimpan data supplier baru
    Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menamilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy']); //menghapus data supplier
});

Route::group(['prefix' => 'level'], function() {
    Route::get('/', [LevelController::class, 'index']);          //menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);   //menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);         //menyimpan data level baru
    Route::get('/{id}', [LevelController::class, 'show']);       //menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  //menamilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);     //menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); //menghapus data level
});

Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data kategori dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   //menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);         //menyimpan data kategori baru
    Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menamilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data kategori
});

Route::group(['prefix' => 'barang'], function() {
    Route::get('/', [BarangController::class, 'index']);          //menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']);      //menampilkan data barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   //menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']);         //menyimpan data barang baru
    Route::get('/{id}', [BarangController::class, 'show']);       //menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  //menamilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); //menghapus data barang
});