<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // public function index()
    // {
        //coba akses model UserModel\
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

        //tambah data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer-3',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 6
        // ];
        // UserModel::insert($data); //tambahkan data ke tabel m_user

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-5')->update($data);
    
        // ============ jobsheet 4 ===========
        // $data = [    //menambahkan data pada 'm_user'
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);    //membuat data baru ke

        // $user = UserModel::all();    //mengambil semua data dari 'm_user'
        // return view('user', ['data' => $user]);

        // $user = UserModel::find(1);  //mengambil data pada tabel ser dengan ID 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 1)->first();    //mengambil data pada tabel user berdasarkan kolom 'level_id' pada baris ke 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstwhere('level_id', 1);    // digunakan untuk mencari data berdasarkan 'level_id' pada baris ke 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::findOr(1, ['username', 'nama'], function () { //menggunakan callbaack untuk menampilkan ke halaman 2 kolom pada ID 1
        //     abort(404);  //menampilkan error jika data tidak ditemukan
        // });
        // return view('user', ['data' => $user]);  //akan dikirimkan ke halaman view 

        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);  // menampilkan error jika data tidak ditemukan
        // });
        // return view('user', ['data' => $user]);  //akan dikirimkan ke halaman view 

        // $user = UserModel::findorfail(1);    //mengambil data pada ID 1
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('username', 'manager9')->firstOrFail(); //mengambil data dengan username 'manager9'
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();    //ambil data dengan level_id '2' dan menampilkan jumlahnya
        // dd($user); //digunakan untuk memberhentikan eksekusi kode dan menampilkan jumlah pengguna
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();    //dd($user) dihilangkan agar eksekuis dari program bisa jalan kembali
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrCreate(    // ditampilkan jika data ada, jika tidak maka akan dibuatkan didatabase
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );
        // return view('user', ['data' => $user]);
        
        // $user = UserModel::firstOrCreate(    //ditampilkan jika data ada, jika tidak maka akan dibuatkan didatabase
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // return view('user', ['data' => $user]); 
        
        // $user = UserModel::firstOrNew(   //akan ditampilkan jika datanya ada, jika tidak maka akan disiapkan untuk dibuatkan pada database
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );
        // return view('user', ['data' => $user]); 

        // $user = UserModel::firstOrNew(   //akan ditampilkan jika datanya ada, jika tidak maka akan disiapkan untuk dibuatkan pada database.
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ],
        // );
        // return view('user', ['data' => $user]); 

        // $user = UserModel::firstOrNew(   //akan ditampilkan jika datanya ada, jika tidak maka akan disiapkan untuk dibuatkan pada database
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();   //dilakukaknnya menyimpan data ketika data tidak ditemukan

        // return view('user', ['data' => $user]); 

        // $user = UserModel::create([  //membuat data baru
        //         'username' => 'manager55',   //dengan username 'manager55'
        //         'nama' => 'Manager55',   //dengan nama 'Manager55'
        //         'password' => Hash::make('12345'),   //dengan password '12345'
        //         'level_id' => 2, //dengan level_id '2'
        //     ]);
        
        // $user->username = 'manager56';   //dirubah username menjadi 'manager56'

        // $user->isDirty();  //true
        // $user->isDirty('username');  //true
        // $user->isDirty('nama');  //false
        // $user->isDirty(['nama', 'username']);  //true

        // $user->isClean(); //false
        // $user->isClean('username'); //false
        // $user->isClean('name'); //true
        // $user->isClean(['nama', 'username']); //false

        // $user->save();

        // $user->isDirty(); //false
        // $user->isClean(); //true 
        // dd($user->isDirty());

    //     $user = UserModel::create([  //membuat data baru
    //         'username' => 'manager11',   // data memiliki username 'manager 11'
    //         'nama' => 'Manager11',   //dengan nama 'Manager 11'
    //         'password' => Hash::make('12345'),   //dan password '12345'
    //         'level_id' => 2, //dengan level_id '2'
    //     ]);
    
    // $user->username = 'manager12';   //mengubah username 'manager 11' menjadi 'manager 12'

    // $user->save();   //disimpan dalam database

    // $user->wasChanged();  //true
    // $user->wasChanged('username');  //true
    // $user->wasChanged(['username', 'level_id']);  //true
    // $user->wasChanged('nama');  //false
    // dd($user->wasChanged(['nama', 'username']));  //true

    // $user = UserModel::all();    //mengambil semua data melalui tabel 'm_user'
    // return view ('user', ['data' => $user]); //mengirimkan data tersebut ke halaman view
    // }

    // public function tambah()
    // {
    //     return view('user_tambah');
    // }
    
    //praktikkum 2.6 no. 9
    // public function tambah_simpan(Request $request) //menerima form melalui inputan
    // {
    //     UserModel::create([ //membuat data baru
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make('$request->password'),
    //         'level_id' => $request->level_id
    //     ]);
    //     return redirect('/user');   //mengirimkan tampilan kepada view 'user.blade.php'
    // }

    //praktikkum 2.6 no. 13
    // public function ubah($id)   //mengambil data yang sesuai dengan ID yang dipilih
    // {
    //     $user = UserModel::find($id);   //mencari ID yang dipilih
    //     return view('user_ubah', ['data' => $user]);    //mengirimkan tampilan ke 'user.blade.php'
    // }

    //praktikkum 2.6 no. 16
    // public function ubah_simpan($id, Request $request)  //digunakan untuk menerima inputan dari form
    // {
    //     $user = UserModel::find($id);   //mencari data yang sesuai berdasarkan ID nya

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save(); //menyimpan perubahan data

    //     return redirect('/user');   //menampilkan hasilnya ke halaman view
    // }

    //praktikkum 2.6 no. 19
    // public function hapus($id)  //menghapus data sesuai ID 
    // {
    //     $user = UserModel::find($id);   //mencari data nya berdasarkan ID
    //     $user->delete();    //menghapus data dari databse

    //     return redirect('/user');   //menampilkan hasil ke tampilan view
    // }

    //praktikkum 2.7 no. 2
    // public function index()  //mengambil semua data dari table user
    // {
    //     $user = UserModel::with('level')->get();
    //     dd($user);   //menampilkan hasil dengan 'die and dump'
    // }

    //praktikkum 2.7 no 4
    // public function index() //mengambil semua data dari tabel user 
    // {
    //     $user = UserModel::with('level')->get();    //data diambil dari tabel user berdasarkan level_id pada user
    //     return view('user', ['data' => $user]); //mengirimkan data nya ketampilan view
    // }

    //jobsheet 5 no 4
    //menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' =>['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // pratikkum 3 no-7 
    // Ambil data user dalam bentuk json untuk datatables
public function list(Request $request)
{
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
        ->with('level');

    return DataTables::of($users)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}
// pratikkum 3 no-8
// Menampilkan halama form tambah user 
public function create(){
    $breadcrumb = (object)[
        'title' => 'Tambah User',
        'list' => ['Home', 'User', 'Tambah']
    ];

    $page = (object)[
        'title' => 'Tambah user baru'
    ];

    $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
    $activeMenu = 'user'; // set menu ysng sedang aktif

    return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level', 'activeMenu' => $activeMenu]);
}

// praktikkum 3 no-11
// menyimpan data user baru 
public function store(Request $request)
{
    $request->validate([
        // usernma harus diisi, berupa string, minimal 3 karakter dan bernilai ditabel m_user kolom username
        'username' => 'required|string|min:3|unique:m_user,username',
        'nama'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimak 100 karakter
        'password' => 'required|min:5',          // password harus diisi dan minimal 5 karakter
        'level_id' => 'required|integer'         // level_id harus diisi dan berupa angka
    ]);

    UserModel::create([
        'username'  => $request->username,
        'nama'      => $request->nama,
        'password'  => bcrypt($request->password),  // password dienskripsi sebelum disimpan
        'level_id'  => $request->level_id,
    ]);

    return redirect('/user')-> with('succes', 'Data user berhasil disimpan');
}
}