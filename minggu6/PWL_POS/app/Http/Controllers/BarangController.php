<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list'  => ['Home', 'Barang']
        ];

        $page = (object)[
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        $kategori = KategoriModel::all();     //ambil data kategori untuk filter kategori

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Ambil data barang dalam bentuk json untuk datatables
public function list(Request $request)
{
    $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id')
    ->with('kategori');

    //filter data user berdasarkan kategori_id
    if ($request->kategori_id) {
        $barangs->where('kategori_id', $request->kategori_id);
    }

    return DataTables::of($barangs)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
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
        'title' => 'Tambah barang',
        'list' => ['Home', 'Barang', 'Tambah']
    ];

    $page = (object)[
        'title' => 'Tambah barang baru'
    ];

    $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
    $activeMenu = 'barang'; // set menu yang sedang aktif

    return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
}

// menyimpan data kategori baru 
public function store(Request $request)
{
    $request->validate([
        // barang_kode harus diisi, berupa string, maksimal 10 karakter dan bernilai ditabel m_barang kolom barang_kode
        'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
        'barang_nama' => 'required|string|max:100', // kategori_nama harus diisi, berupa string, dan maksimal 100 karakter
        'harga_jual'  => 'required|integer',// harga_jual harus diisi, berupa integer
        'harga_beli'  => 'required|integer', // harga_beli harus diisi, berupa integer
        'kategori_id' => 'required|integer', // kategori_id harus diisi, berupa integer
    ]);

    BarangModel::create([
        'barang_kode'  => $request->barang_kode,
        'barang_nama'  => $request->barang_nama,
        'harga_jual'   => $request->harga_jual,
        'harga_beli'   => $request->harga_beli,
        'kategori_id'  => $request->kategori_id
    ]);

    return redirect('/barang')-> with('success', 'Data barang berhasil disimpan');
}

// menampilkan detail
public function show(string $id)
{
$barang = BarangModel::with('kategori')->find($id);

$breadcrumb = (object)[
    'title' => 'Detail barang',
    'list' => ['Home', 'Barang', 'Detail']
];
$page = (object)[
    'title' => 'Detail Barang'
    ];
    $activeMenu = 'barang';   // set menu yang aktif

    return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
}

// menampilkan halaman form edit barang
public function edit(string $id)
{
    $barang = BarangModel::find($id);
    $kategori = KategoriModel::all();

    $breadcrumb = (object)[
        'title' => 'Edit Barang',
        'list' => ['Home', 'Barang', 'Edit']
    ];

    $page = (object)[
        'title' => 'Edit Barang'
    ];

    $activeMenu = 'barang';   // set menu yang sedang aktif

    return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
}

// menyimpan perubahan data barang
public function update(Request $request, string $id)
{
    $request->validate([
        // barang_kode harus diisi, berupa string, maximal 10 karakter,
        // dan bernilai unik ditabel m_kategori kolom kategori_id untuk kategori dengan id yang sedang diedit
        'barang_kode'   => 'required|string|max:10|unique:m_barang,barang_kode,'.$id. ',barang_id',
        'barang_nama'   => 'required|string|max:100',    // kategori_nama harus diisi, berupa string, dan maksimal 100 karakter
        'harga_jual'    => 'required|integer',    // harga_jual harus diisi, berupa integer
        'harga_beli'    => 'required|integer',    // harga_beli harus diisi, berupa integer
        'kategori_id'   => 'required|integer',    // kategori_id harus diisi, berupa integer
    ]);

    BarangModel::find($id)->update([
        'barang_kode' => $request->barang_kode,
        'barang_nama' => $request->barang_nama,
        'harga_jual'  => $request->harga_jual,
        'harga_beli'  => $request->harga_beli,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect('/barang')->with('success', 'Data barang berhasil diubah');
}

// menghapus data barang 
public function destroy(string $id)
{
    $check = BarangModel::find($id);
    if (!$check) {  // untuk mengecek apakah data barang dengan id yang dimaksud ada atau tidak
        return redirect('/barang')->with('error', 'Data kategori tidak ditemukan');
    }

    try {
        BarangModel::destroy($id);    // hapus data kategori

        return redirect('/barang')->with('success', 'Data kategori berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/barang')->with('error', 'Data gagal dihapus karena masuh terdapat tabel lain yang terkait dengan data ini');
    }
}
}