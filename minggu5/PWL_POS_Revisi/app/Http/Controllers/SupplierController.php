<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\SupplierModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    // menampilkan halaman awal supplier
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar supplier',
            'list' =>['Home', 'Supplier']
        ];

        $page = (object)[
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

     // Ambil data supplier dalam bentuk json untuk datatables
    public function list(Request $request)
    {
    $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

    return DataTables::of($supplier)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi
            $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
                . csrf_field() 
                . method_field('DELETE') 
                . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }
    // Menampilkan halaman form tambah supplier 
    public function create()
    {
    $breadcrumb = (object)[
        'title' => 'Tambah Supplier',
        'list' => ['Home', 'Supplier', 'Tambah']
    ];

    $page = (object)[
        'title' => 'Tambah supplier baru'
    ];

    $activeMenu = 'supplier'; // set menu yang sedang aktif

    return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
}

// menyimpan data supplier baru 
public function store(Request $request)
{
    $request->validate([
        // supplier_kode harus diisi, berupa string, maksimal 10 karakter dan bernilai ditabel m_supplier kolom supplier_kode
        'supplier_kode'   => 'required|string|max:10|unique:m_supplier,supplier_kode',
        'supplier_nama'   => 'required|string|max:100',   // supplier_nama harus diisi, berupa string, dan maksimal 100 karakter
        'supplier_alamat' => 'required|max:255',          // supplier_alamat harus diisi dan minimal 255 karakter
    ]);

    SupplierModel::create([
        'supplier_kode'     => $request->supplier_kode,
        'supplier_nama'     => $request->supplier_nama,
        'supplier_alamat'   => $request->supplier_alamat
    ]);

    return redirect('/supplier')-> with('succes', 'Data supplier berhasil disimpan');
}

// menampilkan detail
public function show(string $id)
{
$supplier = SupplierModel::find($id);

$breadcrumb = (object)[
    'title' => 'Detail Supplier',
    'list' => ['Home', 'supplier', 'Detail']
];
$page = (object)[
    'title' => 'Detail supplier'
    ];
    $activeMenu = 'supplier';   // set menu yang aktif

    return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
}

// menampilkan halaman form edit supplier
public function edit(string $id)
{
    $supplier = SupplierModel::find($id);

    $breadcrumb = (object)[
        'title' => 'Edit Supplier',
        'list' => ['Home', 'Supplier', 'Edit']
    ];

    $page = (object)[
        'title' => 'Edit Supplier'
    ];

    $activeMenu = 'supplier';   // set menu yang sedang aktif

    return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
}

// menyimpan perubahan data user
public function update(Request $request, string $id)
{
    $request->validate([
        // supplier_kode harus diisi, berupa string, minimal 3 karakter,
        // dan bernilai unik ditabel m_user kolom username untuk user dengan id yang sedang diedit
        'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,'.$id. ',supplier_id',
        'supplier_nama'     => 'required|string|max:100',    // supplier_nama harus diisi, berupa string, dan maksimal 100 karakter
        'supplier_alamat' => 'required|string|max:255',             // supplier_alamat harus diisi, berupa string, dan maksimal 255 karakter
    ]);

    SupplierModel::find($id)->update([
        'supplier_kode' => $request->supplier_kode,
        'supplier_nama'     => $request->supplier_nama,
        'suppier_alamat' => $request->supplier_alamat
    ]);

    return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
}

// menghapus data user 
public function destroy(string $id)
{
    $check = SupplierModel::find($id);
    if (!$check) {  // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
    }

    try {
        SupplierModel::destroy($id);    // hapus data level

        return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/supplier')->with('error', 'Data gagal dihapus karena masuh terdapat tabel lain yang terkait dengan data ini');
    }
}
}