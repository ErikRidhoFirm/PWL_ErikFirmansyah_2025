<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Menampilkan halaman awal stok
    public function index()
    {
        $data = DB::select('select * from t_stok');
        
        $breadcrumb = (object) [
            'title' => 'Data Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar data stok barang'
        ];

        $activeMenu = 'stok';

        $barang = BarangModel::all(); // untuk filter barang
        $supplier = SupplierModel::all(); // untuk filter supplier

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'supplier'));
    }

    // Ambil data stok dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $stok = StokModel::select('barang_id', 'supplier_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->with(['barang', 'user', 'supplier']);

        if ($request->barang_id) {
            $stok->where('barang_id', $request->barang_id);
        }

        if ($request->supplier_id) {
            $stok->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($s) {
                //$btn  = '<a href="' . url('/stok/' . $s->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                //$btn .= '<a href="' . url('/stok/' . $s->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                //$btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $s->stok_id) . '">'
                  //    . csrf_field()
                    //  . method_field('DELETE')
                      //. '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</button>'
                      //. '</form>';
                //return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/stok/' . $s->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $s->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $s->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah data stok baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        $supplier = SupplierModel::all();
        $activeMenu = 'stok';

        return view('stok.create', compact('breadcrumb', 'page', 'barang', 'user', 'supplier', 'activeMenu'));
    }

    // Simpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::create($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Tampilkan detail stok
    public function show($id)
    {
        $stok = StokModel::with(['barang', 'user', 'supplier'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data stok'
        ];

        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
    }

    // Tampilkan form edit stok
    public function edit($id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();
        $supplier = SupplierModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit data stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'barang', 'user', 'supplier', 'activeMenu'));
    }

    // Simpan perubahan data stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::find($id)->update($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    // Hapus data stok
    public function destroy($id)
    {
        $check = StokModel::find($id);

        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Gagal menghapus data stok karena data masih terhubung dengan tabel lain');
        }
    }

 public function confirm_ajax($id)
{
   $stok = StokModel::find($id);
   return view('stok.confirm_ajax', compact('stok'));
}

    public function delete_ajax(Request $request, $id)
    {
        // Mengecek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $stok = StokModel::find($id);
            if ($stok) {
                try {
                    $stok->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak bisa dihapus'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function create_ajax()
   {
       $barang = BarangModel::select('barang_id', 'barang_nama')->get();
       $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get(); // Ambil data supplier

       return view('stok.create_ajax', [
           'barang' => $barang,
           'supplier' => $supplier
       ]);
   }

   // Simpan data stok baru
   public function store_ajax(Request $request)
   {
       try {
           $rules = [
               'barang_id' => ['required', 'integer', 'exists:m_barang,barang_id'],
               'supplier_id' => ['required', 'integer', 'exists:m_supplier,supplier_id'],
               'stok_tanggal' => ['required', 'date_format:Y-m-d\TH:i'],
               'stok_jumlah' => ['required', 'integer', 'min:1'],
           ];

           $validator = Validator::make($request->all(), $rules);

           if ($validator->fails()) {
               return response()->json([
                   'status'   => false,
                   'message'  => 'Validasi gagal.',
                   'msgField' => $validator->errors(),
               ]);
           }

           $data = $request->all();
           $data['user_id'] = auth()->id();

           // Convert datetime-local to proper format
           $data['stok_tanggal'] = \Carbon\Carbon::parse($data['stok_tanggal'])->format('Y-m-d H:i:s');

           StokModel::create($data);

           return response()->json([
               'status'  => true,
               'message' => 'Data stok berhasil disimpan.',
           ]);

       } catch (\Throwable $e) {
           Log::error($e);
           return response()->json([
               'status' => false,
               'message' => 'Server error: ' . $e->getMessage()
           ], 500);
       }
   }

   public function edit_ajax(string $id)
   {
       $stok = StokModel::find($id);
       $barang = BarangModel::select('barang_id', 'barang_nama')->get();
       $user = UserModel::select('user_id', 'nama')->get();
       $supplier = SupplierModel::select('supplier_id', 'supplier_nama')->get(); // Ambil daftar supplier

       return view('stok.edit_ajax', [
           'stok' => $stok,
           'barang' => $barang,
           'supplier_id' => $supplier,
           'user' => $user,
           'supplier' => $supplier,
       ]);
   }

   // Update data stok
   public function update_ajax(Request $request, $id)
   {
       if ($request->ajax() || $request->wantsJson()) {
           $rules = [
               'barang_id'    => ['required', 'integer', 'exists:m_barang,barang_id'],
               'user_id'      => ['required', 'integer', 'exists:m_user,user_id'],
               'supplier_id'  => ['required', 'integer', 'exists:m_supplier,id'], // validasi supplier
               'stok_tanggal' => ['required', 'date'],
               'stok_jumlah'  => ['required', 'integer', 'min:1'],
           ];

           $validator = Validator::make($request->all(), $rules);

           if ($validator->fails()) {
               return response()->json([
                   'status'   => false,
                   'message'  => 'Validasi gagal.',
                   'msgField' => $validator->errors(),
               ]);
           }

           $stok = StokModel::find($id);
           if ($stok) {
               $stok->update($request->all());

               return response()->json([
                   'status'  => true,
                   'message' => 'Data stok berhasil diupdate.',
               ]);
           }

           return response()->json([
               'status'  => false,
               'message' => 'Data tidak ditemukan.',
           ]);
       }
   }

   public function show_ajax(string $id)
    {
        $stok = StokModel::find($id);
       
        return view('stok.show_ajax', ['stok' => $stok]);
    }
    public function import()
{
    return view('stok.import');
}

public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_stok');  // ambil file dari request

            $reader = IOFactory::createReader('Xlsx');  // load reader file excel
            $reader->setReadDataOnly(true);     // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath());     // ambil sheet yang aktif
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif

            $data = $sheet->toArray(null, false, true, true);   // ambil data excel

            $insert = [];
            if (count($data) > 1) {     // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {   // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'supplier_id' => $value['A'],
                            'barang_id' => $value['B'],
                            'user_id' => $value['C'],
                            'stok_tanggal' => $value['D'],
                            'stok_jumlah' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    StokModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport',
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
        $stok = StokModel::select('supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->orderBy('stok_id')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();        // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'supplier_id');
        $sheet->setCellValue('C1', 'barang_id');
        $sheet->setCellValue('D1', 'user_id');
        $sheet->setCellValue('E1', 'stok_tanggal');
        $sheet->setCellValue('F1', 'stok_jumlah');

        $sheet->getStyle('A1:C1')->getFont()->setBold(true);    // bold header
        $no = 1;    // nomor data dimulai dari 1
        $baris = 2;     // baris data dimulai dari baris ke 2
        foreach ($stok as $key => $value) {
            $sheet->setCellvalue('A' . $baris, $no);
            $sheet->setCellvalue('B' . $baris, $value->supplier_id);
            $sheet->setCellvalue('C' . $baris, $value->barang_id);
            $sheet->setCellvalue('D' . $baris, $value->user_id);
            $sheet->setCellvalue('E' . $baris, $value->stok_tanggal);
            $sheet->setCellvalue('F' . $baris, $value->stok_jumlah);
            $baris++;
            $no++;
        }
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);   // set auto size untuk kolom
        }
        $sheet->setTitle('Data Stok'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Stok ' . date('Y-m-d H:i:s') . '.xlsx';

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
            $stok = StokModel::select('supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
                        ->orderBy('supplier_id')
                        ->get();
            // use Barryvdh\DomPDF\Facade\Pdf;
            $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);
            $pdf->setPaper('a4', 'portrait');   // set ukuran kertas dan orientasi
            $pdf->setOption("isRemoteEnabled", true);   // set true jika ada gambar dari url
            $pdf->render();
    
            return $pdf->stream('Data Stok '.date('Y-m-d H-i-s').'.pdf');
        }
}