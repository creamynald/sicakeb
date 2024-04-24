<?php

namespace App\Http\Controllers\backend\perjanjianKinerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerjanjianKinerja\Realisasi;
use App\Models\PerjanjianKinerja\Target;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use App\Models\Opd\Kegiatan;
use App\Models\Opd\Subkegiatan;
use App\Models\Opd\Program;
use DataTables;

class CapaianController extends Controller
{
    //
    public function index(Request $request)
    {
        // begin::get data using yajra
        if ($request->ajax()) {
            // BUTUH KOREKSI UNTUK KEMUDIAN HARI KETIKA OPERATOR OPD TELAH DIBUAT MAKA HARUS ADA KONDISI WHERE UNTUK MENAMPILKAN DATA SESUAI YANG LOGIN
            $data = Pegawai::with('opd')->whereOpdId(auth()->user()->opd_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
            <div class="d-flex justify-content-end flex-shrink-0">
                <a href="' . route('rincianCapaian', $row->id) . '" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
            </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        $pegawai = Pegawai::whereOpdId(auth()->user()->opd_id)->get();
        $opd = opd::get();
        return view('backend.realisasi.index', compact('opd', 'pegawai'));
    }

    public function rincianCapaian(string $id){
        // mendapatkan tahun
        $year = isset($_GET['periode']) ? $_GET['periode'] : date('Y');

        $pegawai = Pegawai::find($id);
        $target = Target::where('pegawai_id', $id)->whereTahun($year)->get();
        $realisasi = new Realisasi;
        return view('backend.capaian.rincian', compact('target', 'realisasi', 'pegawai'));
    }
}
