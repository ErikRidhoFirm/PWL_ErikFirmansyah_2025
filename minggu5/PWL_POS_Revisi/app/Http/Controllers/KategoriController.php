<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // public function index()
    // {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode','SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row. ' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row. ' baris';

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data' => $data]);
    // }

    // menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kategori',
            'list'  => ['Home', 'Kategori']
        ];

        $page = (object)[
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kategori dalam bentuk json untuk datatables
public function list(Request $request)
{
    $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

    return DataTables::of($kategoris)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}

// Menampilkan halaman form tambah kategori 
public function create(){
    $breadcrumb = (object)[
        'title' => 'Tambah Kategori',
        'list' => ['Home', 'Kategori', 'Tambah']
    ];

    $page = (object)[
        'title' => 'Tambah kategori baru'
    ];

    $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
    $activeMenu = 'kategori'; // set menu ysng sedang aktif

    return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}

// menyimpan data kategori baru 
public function store(Request $request)
{
    $request->validate([
        // usernma harus diisi, berupa string, maksimal 10 karakter dan bernilai ditabel m_kategori kolom kategori_kode
        'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_id',
        'kategori_nama' => 'required|string|max:100' // kategori_nama harus diisi, berupa string, dan maksimal 100 karakter
    ]);

    KategoriModel::create([
        'kategori_kode'  => $request->kategori_kode,
        'kategori_nama'  => $request->kategori_nama
    ]);

    return redirect('/kategori')-> with('succes', 'Data kategori berhasil disimpan');
}

// menampilkan detail
public function show(string $id)
{
$kategori = KategoriModel::find($id);

$breadcrumb = (object)[
    'title' => 'Detail Kategori',
    'list' => ['Home', 'Kategori', 'Detail']
];
$page = (object)[
    'title' => 'Detail Kategori'
    ];
    $activeMenu = 'kategori';   // set menu yang aktif

    return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}

// menampilkan halaman form edit kategori
public function edit(string $id)
{
    $kategori = KategoriModel::find($id);

    $breadcrumb = (object)[
        'title' => 'Edit Kategori',
        'list' => ['Home', 'Kategori', 'Edit']
    ];

    $page = (object)[
        'title' => 'Edit Kategori'
    ];

    $activeMenu = 'kategori';   // set menu yang sedang aktif

    return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}

// menyimpan perubahan data kategori
public function update(Request $request, string $id)
{
    $request->validate([
        // kategori_id harus diisi, berupa string, maximal 10 karakter,
        // dan bernilai unik ditabel m_kategori kolom kategori_id untuk kategori dengan id yang sedang diedit
        'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,'.$id. ',kategori_id',
        'kategori_nama' => 'required|string|max:100',    // kategori_nama harus diisi, berupa string, dan maksimal 100 karakter
    ]);

    KategoriModel::find($id)->update([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
    ]);

    return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
}

// menghapus data kategori 
public function destroy(string $id)
{
    $check = KategoriModel::find($id);
    if (!$check) {  // untuk mengecek apakah data kategori dengan id yang dimaksud ada atau tidak
        return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
    }

    try {
        KategoriModel::destroy($id);    // hapus data kategori

        return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/kategori')->with('error', 'Data gagal dihapus karena masuh terdapat tabel lain yang terkait dengan data ini');
    }
}
}
