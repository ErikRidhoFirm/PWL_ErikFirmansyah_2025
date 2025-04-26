<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\KategoriModel;
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
// Route::get('/', [WelcomeController::class, 'index']);

// // jobsheet 6 prak-1 no-6
// // Route User
// Route::group(['prefix' => 'user'], function () {
//     Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
//     Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [UserController::class, 'create']);   //menampilkan halaman form tambah user
//     Route::post('/', [UserController::class, 'store']);         //menyimpan data user baru
//     Route::get('/create_ajax', [UserController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
//     Route::post('/ajax', [UserController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
//     Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
//     Route::get('/{id}/edit', [UserController::class, 'edit']);  //menamilkan halaman form edit user
//     Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
//     Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
//     Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
//     Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);     //untuk hapus data user ajax
//     Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user
// });

// // Tugas Jobsheet 6
// // Route Supplier
// Route::group(['prefix' => 'supplier'], function () {
//     Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal user
//     Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah user
//     Route::post('/', [SupplierController::class, 'store']);         //menyimpan data user baru
//     Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
//     Route::post('/ajax', [SupplierController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
//     Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail user
//     Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menamilkan halaman form edit user
//     Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
//     Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
//     Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
//     Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);     //untuk hapus data user ajax
//     Route::delete('/{id}', [SupplierController::class, 'destroy']); //menghapus data user
// });

// // Tugas Jobsheet 6
// // Route level
// Route::group(['prefix' => 'level'], function () {
//     Route::get('/', [LevelController::class, 'index']);          //menampilkan halaman awal user
//     Route::post('/list', [LevelController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [LevelController::class, 'create']);   //menampilkan halaman form tambah user
//     Route::post('/', [LevelController::class, 'store']);         //menyimpan data user baru
//     Route::get('/create_ajax', [LevelController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
//     Route::post('/ajax', [LevelController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
//     Route::get('/{id}', [LevelController::class, 'show']);       //menampilkan detail user
//     Route::get('/{id}/edit', [LevelController::class, 'edit']);  //menamilkan halaman form edit user
//     Route::put('/{id}', [LevelController::class, 'update']);     //menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
//     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
//     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
//     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);     //untuk hapus data user ajax
//     Route::delete('/{id}', [LevelController::class, 'destroy']); //menghapus data user
// });

// // Tugas Josbheet 6
// // Route Kategori
// Route::group(['prefix' => 'kategori'], function () {
//     Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal user
//     Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [KategoriController::class, 'create']);   //menampilkan halaman form tambah user
//     Route::post('/', [KategoriController::class, 'store']);         //menyimpan data user baru
//     Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
//     Route::post('/ajax', [KategoriController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
//     Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail user
//     Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menamilkan halaman form edit user
//     Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
//     Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
//     Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
//     Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);     //untuk hapus data user ajax
//     Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data user
// });

// // tugas jobsheet 6
// // route barang
// Route::group(['prefix' => 'barang'], function () {
//     Route::get('/', [BarangController::class, 'index']);          //menampilkan halaman awal user
//     Route::post('/list', [BarangController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
//     Route::get('/create', [BarangController::class, 'create']);   //menampilkan halaman form tambah user
//     Route::post('/', [BarangController::class, 'store']);         //menyimpan data user baru
//     Route::get('/create_ajax', [BarangController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
//     Route::post('/ajax', [BarangController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
//     Route::get('/{id}', [BarangController::class, 'show']);       //menampilkan detail user
//     Route::get('/{id}/edit', [BarangController::class, 'edit']);  //menamilkan halaman form edit user
//     Route::put('/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data user
//     Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
//     Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
//     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
//     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);     //untuk hapus data user ajax
//     Route::delete('/{id}', [BarangController::class, 'destroy']); //menghapus data user
// });


// ============ Jobsheet 7 ==============
Route::pattern('id', '[0-9]+');     // artinya ketika ada parameter (id), maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

// =========== Jobsheet 7 Tugas No. 1 ===========
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister']);

Route::middleware(['auth'])->group(function () {  // artinya semua route didalam group ini harus login dulu

    Route::get('/', [WelcomeController::class, 'index']);

    // Route::middleware(['authorize:ADM'])->group(function(){
    // ======== Jobsheet 7 tugas 4 ======== 
    // artinya semua route didalam group ini harus punya role ADM (Administrator)
    Route::prefix('level')->middleware(['authorize:ADM'])->group(function () {
        Route::get('/', [LevelController::class, 'index']);          //menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']);   //menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']);         //menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);     //Menampilkan halaman form tambah level ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']);     //Menyimpan datalevel baru ajax
        Route::get('/{id}', [LevelController::class, 'show']);       //menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']);  //menamilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);     //menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);     //menampilkan halaman form edit level ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);     //menyimpan perubahan data level ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete level ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);     //untuk hapus data level ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); //menghapus data level
        Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [LevelController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // export pdf

    });

    // route barang
    // ======= Jobsheet 7 prak-3 no-3 =======
    // artinya semua route didalam group ini harus punya role ADM (Administrator), MNG (Manager)
    // Route::prefix('barang')->middleware(['authorize:ADM,MNG'])->group(function(){

    // ======== Jobsheet 7 tugas 4 ======== 
    // artinya semua route didalam group ini harus punya role ADM (Administrator), MNG (Manager) dan STE (Staff/Kasir)
    Route::prefix('barang')->middleware(['authorize:ADM,MNG,STE'])->group(function () {
        Route::get('/', [BarangController::class, 'index']);          //menampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);      //menampilkan data barang dalam bentuk json untuk datatables
        Route::get('/create', [BarangController::class, 'create']);   //menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);         //menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);     //Menampilkan halaman form tambah barang ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']);     //Menyimpan databarang baru ajax
        Route::get('/{id}', [BarangController::class, 'show']);       //menampilkan detail barang
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  //menamilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);     //menampilkan halaman form edit barang ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);     //menyimpan perubahan data barang ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete barang ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);     //untuk hapus data barang ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); //menghapus data barang
        Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
        Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // export pdf

    });

    // Route Supplier
    // Route::group(['prefix' => 'supplier'], function() {

    // ======== Jobsheet 7 tugas 4 ======== 
    // artinya semua route didalam group ini harus punya role ADM (Administrator), MNG (Manager)
    Route::prefix('supplier')->middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal supplier
        Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data supplier dalam bentuk json untuk datatables
        Route::get('/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class, 'store']);         //menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);     //Menampilkan halaman form tambah supplier ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);     //Menyimpan datasupplier baru ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail supplier
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menamilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);     //menampilkan halaman form edit supplier ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);     //menyimpan perubahan data supplier ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete supplier ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);     //untuk hapus data supplier ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); //menghapus data supplier
        Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [SupplierController::class, 'export_excel']); // export excel  
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']); // export pdf
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // export pdf
    });


    // Route Kategori
    // Route::group(['prefix' => 'kategori'], function() {

    // ======== Jobsheet 7 tugas 4 ======== 
    // artinya semua route didalam group ini harus punya role ADM (Administrator), MNG (Manager)
    Route::prefix('kategori')->middleware(['authorize:ADM,MNG'])->group(function () {
        Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal kategori
        Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']);   //menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class, 'store']);         //menyimpan data kategori baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);     //Menampilkan halaman form tambah kategori ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);     //Menyimpan datakategori baru ajax
        Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail kategori
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menamilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data kategori
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);     //menampilkan halaman form edit kategori ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);     //menyimpan perubahan data kategori ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete kategori ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);     //untuk hapus data kategori ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data kategori
        Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [KategoriController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // export pdf
    });

    // route user
    // Route::group(['prefix' => 'user'], function() {

    // ======== Jobsheet 7 tugas 4 ======== 
    // artinya semua route didalam group ini harus punya role ADM (Administrator)
    Route::prefix('user')->middleware(['authorize:ADM'])->group(function () {
        Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);   //menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);         //menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);     //Menampilkan halaman form tambah user ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);     //Menyimpan datauser baru ajax
        Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);  //menamilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     //menampilkan halaman form edit user ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     //menyimpan perubahan data user ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);     //untuk hapus data user ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user
        Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [UserController::class, 'export_pdf']); // export pdf
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail

    });
    Route::group(['prefix' => 'stok'], function () {
        Route::get('/', [StokController::class, 'index']);                // Menampilkan halaman awal user
        Route::post('/list', [StokController::class, 'list']);            // Menampilkan data user dalam bentuk json untuk datatable
        Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [StokController::class, 'store_ajax']);      // Menyimpan data user baru Ajax
        Route::get('/{id}', [StokController::class, 'show']);             // Menampilkan detail user
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);     //untuk tampilkan form confirm delete user ajax
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk hapus data user Ajax
        Route::delete('/{id}', [StokController::class, 'destroy']);       // Menghapus data user
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // menampilkan detail
        Route::get('/import', [StokController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [StokController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [StokController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [StokController::class, 'export_pdf']); // export pdf
    });

    Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/', [PenjualanController::class, 'index']);      //menampilkan halaman penjualan
    Route::post('/list', [PenjualanController::class, 'list']);      //menampilkan data penjualan dalam bentuk json untuk datatables
    Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);     //menampilkan halaman form tambah penjualan ajax
    Route::post('/ajax', [PenjualanController::class, 'store_ajax']);            //menyimpan data penjualan baru ajax
    Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);    //menampilkan halaman form edit penjualan ajax
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);    //menyimpan perubahan data penjualan ajax
    Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);       //menampilkan form confirm delete penjualan ajax
    Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);     //menghapus data penjualan ajax
    Route::get('/{id}/show_ajax', [PenjualanController::class, 'show_ajax']);        //menampilkan detail penjualan ajax
    Route::get('/import', [PenjualanController::class, 'import']); // ajax form upload excel
    Route::post('/import_ajax', [PenjualanController::class, 'import_ajax']); // ajax import excel
    Route::get('/export_excel', [PenjualanController::class, 'export_excel']); // export excel
    Route::get('/export_pdf', [PenjualanController::class, 'export_pdf']); // export pdf

});   
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/profile_ajax', [UserController::class, 'profile_ajax']);
    Route::post('/profile_update', [UserController::class, 'profile_update']); 
});

// ======== Jobsheet 8 tugas 4 ========
// route barang 
// Route::get('/barang', [BarangController::class, 'index']);
// Route::post('/barang/list', [BarangController::class, 'list']);
// Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // ajax form create
// Route::post('/barang_ajax', [BarangController::class, 'store_ajax']); // ajax store
// Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // ajax form edit
// Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // ajax update
// Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // ajax form confirm
// Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // ajax delete

// // route level 
// Route::get('/level', [LevelController::class, 'index']);
// Route::post('/level/list', [LevelController::class, 'list']);
// Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // ajax form create
// Route::post('/level_ajax', [LevelController::class, 'store_ajax']); // ajax store
// Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // ajax form edit
// Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // ajax update
// Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // ajax form confirm
// Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // ajax delete

// // route kategori
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::post('/kategori/list', [KategoriController::class, 'list']);
// Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']); // ajax form create
// Route::post('/kategori_ajax', [KategoriController::class, 'store_ajax']); // ajax store
// Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // ajax form edit
// Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // ajax update
// Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // ajax form confirm
// Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // ajax delete

// // route supplier
// Route::get('/supplier', [SupplierController::class, 'index']);
// Route::post('/supplier/list', [SupplierController::class, 'list']);
// Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']); // ajax form create
// Route::post('/supplier_ajax', [SupplierController::class, 'store_ajax']); // ajax store
// Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // ajax form edit
// Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // ajax update
// Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // ajax form confirm
// Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // ajax delete


// // route user
// Route::get('/user', [UserController::class, 'index']);
// Route::post('/user/list', [UserController::class, 'list']);
// Route::get('/user/create_ajax', [UserController::class, 'create_ajax']); // ajax form create
// Route::post('/user_ajax', [UserController::class, 'store_ajax']); // ajax store
// Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // ajax form edit
// Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']); // ajax update
// Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // ajax form confirm
// Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // ajax delete