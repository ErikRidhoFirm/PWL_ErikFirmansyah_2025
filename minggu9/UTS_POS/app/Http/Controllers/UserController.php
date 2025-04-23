<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Monolog\Level;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
    // public function index()
    // {
    //     $breadcrumb = (object)[
    //         'title' => 'Daftar User',
    //         'list' =>['Home', 'User']
    //     ];

    //     $page = (object)[
    //         'title' => 'Daftar user yang terdaftar dalam sistem'
    //     ];

    //     $activeMenu = 'user'; // set menu yang sedang aktif
    //     return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    // }

    // praktikkum 4 no 1
    // menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        $level = LevelModel::all();     //ambil data level untuk filter level

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // pratikkum 3 no-7 
    // Ambil data user dalam bentuk json untuk datatables
    // public function list(Request $request)
    // {
    //     $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
    //         ->with('level');

    //     return DataTables::of($users)
    //         // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                 '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    //         ->make(true);
    // }

    //praktikkum 4 no 5
    //Ambil data user dalam bentuk json untuk datatables
    // public function list(Request $request)
    // {
    //     $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
    //         ->with('level');

    //         //filter data user berdasarkan level_id
    //         if ($request->level_id) {
    //             $users->where('level_id', $request->level_id);
    //         }
    //     return DataTables::of($users)
    //         // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
    //                 . csrf_field() . method_field('DELETE') .
    //                 '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    //         ->make(true);
    // }

    // pratikkum 3 no-8
    // Menampilkan halama form tambah user 
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu ysng sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
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

        return redirect('/user')->with('succes', 'Data user berhasil disimpan');
    }

    // praktikkum 3 no 14
    // menampilkan detail
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail user'
        ];
        $activeMenu = 'user';   // set menu yang aktif

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // praktikkum 3 no-18
    // menampilkan halama form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';   // set menu yang sedang aktif

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik ditabel m_user kolom username untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama'     => 'required|string|max:100',    // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'nullable|min:5',             // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
            'level_id' => 'required|integer'            // level_id harus diisi dan berupa angka
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    // praktikkum 3 no-22
    // menghapus data user 
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {  // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);    // hapus data level

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data gagal dihapus karena masuh terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // Jobsheet 6 prak-1 no-7
    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
            ->with('level', $level);
    }

    // prak-1 no-9
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // 'level_id' => 'required|integer',
                // 'username' => 'required|string|min:3|unique:m_user,username',
                // 'nama'     => 'required|string|max:100',
                // 'password' => 'required|min:6',

                // ====== Jobsheet 8 Tugas 1 ======
                'level_id' => ['required', 'integer'],
                'username' => ['required', 'string', 'min:3', 'unique:m_user,username'],
                'nama'     => ['required', 'string', 'max:100'],
                'password' => ['required', 'min:6'],
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, // response status, false: error/gagal, true: berhasil
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // pesan error validasi
                ]);
            }

            UserModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
            ]);
        }
        redirect('/');
    }

    // prak-2 no-2
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        //filter data user berdasarkan level_id
        // if ($request->level_id) {
        //     $users->where('level_id', $request->level_id);
        // }

        // ====== Jobsheet 8 Tugas 1 ========
        $level_id = $request->input('filter_level');
        if (!empty($level_id)) {
            $users->where('level_id', $level_id);
        }
        return DataTables::of($users)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                // $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';

                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // prak-2 no-4
    // menampilkan halaman form edit user ajax
    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    // prak-2 no-6
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // 'level_id' => 'required|integer',
                // 'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id',
                // 'nama' => 'required|max:100',
                // 'password' => 'nullable|min:6|max:20'

                // ======== Jobsheet 8 Tugsd 1 ========
                'level_id' => ['required', 'integer'],
                'username' => ['required', 'string', 'min:3', 'unique:m_user,username,' . $id . ',user_id'],
                'nama'     => ['required', 'string', 'max:100'],
                'password' => ['required', 'min:6'],
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
                    $request->request->remove('password');
                }

                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // prak-3 no-3
    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }

    // prak-3 no-5
    public function delete_ajax(Request $request, $id)
    {
        //cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // ======== Jobsheet 8 Tugas 1 =======
    public function import()
    {
        return view('user.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                //validasi file harus xls atau xlsx, max 1MB
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgFiled'  => $validator->errors()
                ]);
            }

            $file = $request->file('file_user');      //ambil file dari request

            $reader = IOFactory::createReader('Xlsx');  //load reader file excel
            $reader->setReadDataOnly(true);             //hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath());     //load file excel
            $sheet = $spreadsheet->getActiveSheet();                //ambil sheet yang aktif

            $data = $sheet->toArray(null, false, true, true);       //ambil data excel

            $insert = [];
            if (count($data) > 1) {     //jika data lebih dari satu baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {   //baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'level_id' => $value['A'],
                            'username' => $value['B'],
                            'nama' => $value['C'],
                            'password' => bcrypt($value['D']),
                            'created_at' => now(),
                        ];
                    }
                }

                //insert data ke database, jika data sudah ada maka diabaikan
                if (count($insert) > 0) {
                    UserModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }

        return redirect('/');
    }

    // ===== Jobsheet 8 Tugas 2 =====
    public function export_excel()
    {
        // ambil data barang yang akan di export
        $user = UserModel::select('level_id', 'username', 'nama')
            ->orderBy('level_id')
            ->with('level')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();        // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Level ID');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Nama');

        $sheet->getStyle('A1:D1')->getFont()->setBold(true);    // bold header
        $no = 1;    // nomor data dimulai dari 1
        $baris = 2;     // baris data dimulai dari baris ke 2
        foreach ($user as $key => $value) {
            $sheet->setCellvalue('A' . $baris, $no);
            $sheet->setCellvalue('B' . $baris, $value->level_id);
            $sheet->setCellvalue('C' . $baris, $value->username);
            $sheet->setCellvalue('D' . $baris, $value->nama);
            $baris++;
            $no++;
        }
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);   // set auto size untuk kolom
        }
        $sheet->setTitle('Data User'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    } // end function export_excel

        // ===== Jobsheet 8 Tugas 3 =====
        public function export_pdf()
        {
            $user = UserModel::select('level_id', 'username', 'nama')
                ->orderBy('level_id')
                ->orderBy('nama')
                ->with('level')
                ->get();
            // use Barryvdh\DomPDF\Facade\Pdf;
            $pdf = Pdf::loadView('user.export_pdf', ['user' => $user]);
            $pdf->setPaper('a4', 'portrait');   // set ukuran kertas dan orientasi
            $pdf->setOption("isRemoteEnabled", true);   // set true jika ada gambar dari url
            $pdf->render();
    
            return $pdf->stream('Data User ' . date('Y-m-d H-i-s') . '.pdf');
        }

        // ===== Jobsheet 8 Tugas 4 ===== 
        public function profile()
    {
        // Ambil user yang sedang login sebagai instance model Eloquent
        $user = auth()->user();

        $breadcrumb = (object) [
            'title' => 'Profil Saya',
            'list' => ['Home', 'Profil']
        ];

        $page = (object) [
            'title' => 'Profil Pengguna'
        ];

        $activeMenu = ''; // set jika diperlukan

        return view('user.profile', compact('user', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function profile_ajax()
    {
        $user = auth()->user();
        return view('user.edit_profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        // Melakukan validasi input file
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|exists:m_user,user_id',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors()
            ]);
        }

        // Mencari data user berdasarkan ID yang dikirim (dari hidden field)
        $user = UserModel::find($request->input('user_id'));

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }

        // Jika ada file foto profil yang diunggah
        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            $file = $request->file('profile_photo');
            $filename = $user->user_id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Hapus file lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan file baru
            $path = $file->storeAs('profiles', $filename, 'public');
            $user->profile_photo = $path;
            $user->save();
        }


        // Simpan perubahan ke database
        $user->save();

        return response()->json([
            'status'  => true,
            'message' => 'Profil berhasil diperbarui'
        ]);
    }
}
