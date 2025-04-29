<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index(){
    $breadcrumb = (object) [
        'title' => 'Transaksi Penjualan',
        'list'  => ['Home', 'Transaksi']
    ];

    $page = (object) [
        'title' => 'Daftar Barang yang terdaftar dalam sistem'
    ];

    $activeMenu = 'penjualan';   //set menu yang sedang aktif

    $penjualan = PenjualanModel::all();     //ambil data level untuk filter level

    return view(
        'penjualan.index', 
        [
            'breadcrumb' => $breadcrumb, 
            'page'       => $page,
            'activeMenu' => $activeMenu,
            'penjualan' => $penjualan
            ]
    );
}  

// Ambil data penjualan dalam bentuk json untuk datatables
public function list(Request $request)
{
    $penjualans = PenjualanModel::select('penjualan_id', 'penjualan_kode', 'penjualan_tanggal', 'pembeli', 'user_id')
                    ->with('user');

    //filter data penjualan berdasarkan user_id
    if ($request->user_id) {
        $penjualans->where('user_id', $request->user_id);
    }

    return DataTables::of($penjualans)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        // menambahkan kolom aksi
        ->addColumn('aksi', function ($penjualan) {
            // JS6 - P1(tambah_ajax)
            $btn  = '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
            $btn .= '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> '; 

            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
}

// JS6 - P1(tambah_ajax)
public function create_ajax() {
    $user = UserModel::select('user_id', 'nama')->get();

    return view('penjualan.create_ajax')->with('user', $user);
}

// JS6 - P1(tambah_ajax)
public function store_ajax(Request $request) {
    // cek apakah request berupa ajax
    if($request->ajax() || $request->wantsJson()) {
        $rules = [
            'penjualan_kode'  => 'required|string|max:20|unique:t_penjualan,penjualan_kode',     
            'penjualan_tanggal'  => 'required|date',   
            'pembeli'   => 'required|string|max:50',   
            'user_id'   => 'required|integer|exists:m_user,user_id',    
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false, // response status, false: error/gagal, true: berhasil
                'message' => 'Validasi gagal',
                'msgField' => $validator->errors(), // pesan error validasi
            ]);
        }

        PenjualanModel::create($request->all()); 

        return response()->json([
            'status' => true,
            'message' => 'Data penjualan berhasil disimpan'
        ]);
    }

    redirect('/');
}

// JS6 - P2(edit_ajax)
//menampilkan halaman form edit penjualan ajax
public function edit_ajax(string $id) {
    $penjualan = PenjualanModel::find($id);
    $user = UserModel::select('user_id', 'nama')->get();

    return view('penjualan.edit_ajax', ['penjualan' => $penjualan, 'user' => $user]);
}

// JS6 - P2(edit_ajax)
public function update_ajax(Request $request, $id) {
    // cek apakah request dari ajax
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'penjualan_kode'     => 'required|string|max:20|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',     
            'penjualan_tanggal'  => 'required|date',   
            'pembeli'            => 'required|string|max:50',   
            'user_id'            => 'required|integer|exists:m_user,user_id',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, // respon json, true: berhasil, false: gagal
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors() // menunjukkan field mana yang error
            ]);
        }

        $check = PenjualanModel::find($id);
        if ($check) {
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

// JS6 - P3(hapus_ajax)
public function confirm_ajax(string $id) {
    $penjualan = PenjualanModel::find($id);

    return view('penjualan.confirm_ajax', ['penjualan' => $penjualan]);
 }

// JS6 - P3(hapus_ajax)
public function delete_ajax(Request $request, $id) {
    // cek apakah request dari ajax
    if ($request->ajax() || $request->wantsJson()) {
        $penjualan = PenjualanModel::find($id);
        if ($penjualan) {
            $penjualan->delete();
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

// JS6 - (show_ajax)
public function show_ajax(string $id) {
    $penjualan = PenjualanModel::with('user')->find($id);

    return view('penjualan.show_ajax', ['penjualan' => $penjualan]);
}

public function import()
{
    return view('penjualan.import');
}

public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_penjualan' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_penjualan');  // ambil file dari request

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
                            'user_id' => $value['A'],
                            'pembeli' => $value['B'],
                            'penjualan_kode' => $value['C'],
                            'penjualan_tanggal' => $value['D'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    PenjualanModel::insertOrIgnore($insert);
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
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->orderBy('penjualan_id')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();        // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID User');
        $sheet->setCellValue('C1', 'Pembeli');
        $sheet->setCellValue('D1', 'Kode Penjualan');
        $sheet->setCellValue('E1', 'Tanggal Penjualan');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);    // bold header
        $no = 1;    // nomor data dimulai dari 1
        $baris = 2;     // baris data dimulai dari baris ke 2
        foreach ($penjualan as $key => $value) {
            $sheet->setCellvalue('A' . $baris, $no);
            $sheet->setCellvalue('B' . $baris, $value->user_id);
            $sheet->setCellvalue('C' . $baris, $value->pembeli);
            $sheet->setCellvalue('D' . $baris, $value->penjualan_kode);
            $sheet->setCellvalue('E' . $baris, $value->penjualan_tanggal);
            $baris++;
            $no++;
        }
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);   // set auto size untuk kolom
        }
        $sheet->setTitle('Data Penjualan'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Penjualan ' . date('Y-m-d H:i:s') . '.xlsx';

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
            $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
                        ->orderBy('penjualan_id')
                        ->get();
            // use Barryvdh\DomPDF\Facade\Pdf;
            $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
            $pdf->setPaper('a4', 'portrait');   // set ukuran kertas dan orientasi
            $pdf->setOption("isRemoteEnabled", true);   // set true jika ada gambar dari url
            $pdf->render();
    
            return $pdf->stream('Data Penjualan '.date('Y-m-d H-i-s').'.pdf');
        }
}
