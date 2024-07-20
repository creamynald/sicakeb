<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opd\Pegawai;
use App\Models\PerjanjianKinerja\Target;
use App\Models\PerjanjianKinerja\Realisasi;
use App\Models\opd;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen\file;
use App\Models\Lhe\Lhe;
use DataTables;

class frontendController extends Controller
{
    public function index()
    {   
        // Data untuk chart pie
        $data = [
            'labels' => ['2021', '2022', '2023'],
            'values' => [67.12, 67.44, 67.60]
        ];

        return view('frontend.beranda.index', compact('data'));
    }

    // Data Mulai Perencanaan Kinerja
    public function getOpdData(Request $request)
    {   
        // begin::get data using yajra
        if($request->ajax()){
            $data = opd::orderBy('urutan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route ('perencanaan.get-data', $row->id).'" class="btn btn-sm btn-light btn-active-light-primary">LIHAT</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        return view('frontend.perencanaan.perencanaan');
    }
    // Data Selesai Perencanaan Kinerja

    // Data Mulai Target Perencanaan Kinerja
    public function getTargetData(Request $request, $opd_id)
    {
        // begin::get data using yajra
        if($request->ajax()){
            $data = Pegawai::with('opd')->whereOpdId($opd_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route('perencanaan.rincianTarget', $row->id).'" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        $pegawai = Pegawai::get();
        $opd = opd::findOrFail($opd_id);
        return view('frontend.target.target', compact('opd','pegawai'));
    }

    public function rincianTarget(Request $request, $id)
    {
        // begin::get data using yajra
        if($request->ajax()){
            $data = Target::with('pegawai')->latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($row){
                $actionBtn = '';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        // end::get data using yajra
        $data_eselon = Pegawai::select('eselon')->findOrFail($id);
        $target = Target::wherePegawaiId($id)->where('tahun', date("Y"))->where('jenis_child', null)->orWhere('jenis_child', 'indikator')->get();
        $pegawai = Pegawai::findOrFail($id);
        return view('frontend.target.rincian', compact('target','pegawai'));
    }
    // Data Selesai Target Perencanaan Kinerja

    // Data Mulai Pengukuran Kinerja
    public function getOpdDataPengukuran(Request $request)
    {   
        // begin::get data using yajra
        if($request->ajax()){
            $data = opd::orderBy('urutan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route ('pengukuran.get-data', $row->id).'" class="btn btn-sm btn-light btn-active-light-primary">LIHAT</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        return view('frontend.pengukuran.pengukuran');
    }

    public function getCapaianData(Request $request, $opd_id)
    {
        // begin::get data using yajra
        if ($request->ajax()) {
            $data = Pegawai::with('opd')->whereOpdId($opd_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
            <div class="d-flex justify-content-end flex-shrink-0">
                <a href="' . route('pengukuran.rincianCapaian', $row->id) . '" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
            </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        $pegawai = Pegawai::whereOpdId($opd_id)->get();
        $opd = opd::findOrFail($opd_id);
        return view('frontend.capaian.capaian', compact('opd', 'pegawai'));
    }

    public function rincianCapaian(string $id){
        $year = isset($_GET['periode']) ? $_GET['periode'] : date('Y');
        $pegawai = Pegawai::find($id);
        $target = Target::wherePegawaiId($id)->where('tahun', date("Y"))->where('jenis_child', null)->orWhere('jenis_child', 'indikator')->get();
        $realisasi = new Realisasi;
        return view('frontend.capaian.rincian', compact('target', 'realisasi', 'pegawai'));
    }
    // Data Selesai Pengukuran Kinerja

    // Data Mulai Pelaporan Kinerja
    public function getOpdDataPelaporan(Request $request)
    {   
        // begin::get data using yajra
        if($request->ajax()){
            $jenis_file = isset($_GET['jenis_file']) ? $_GET['jenis_file'] : null;
            $data = opd::orderBy('urutan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use ($jenis_file){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route ('pelaporan.get-data', $row->id).'?jenis_file='.$jenis_file.'" class="btn btn-sm btn-light btn-active-light-primary">LIHAT</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        return view('frontend.pelaporan.pelaporan');
    }

    public function getFileData(Request $request, $opd_id)
    {
        $jenis_file = isset($_GET['jenis_file'])? $_GET['jenis_file'] : '';
        $query = file::with('opd')->whereOpdId($opd_id)->whereJenisFile($jenis_file)->latest();
        
        if ($request->has('jenis_file') && !empty($request->jenis_file)) {$query->where('jenis_file', $request->jenis_file);}
        $opd = opd::findOrFail($opd_id);
        $data = $query->paginate(10);

        return view('frontend.file.file', compact('data','opd'));
    }

    public function download($folder,$filename)
    {
        $path = "dokumen/".$folder.'/'.$filename;

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'File Tidak Ditemukan');
        }
        $mimeType = Storage::mimeType($path);

        return response()->make(Storage::disk('local')->get($path)
        , 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
    // Data Selesai Pelaporan Kinerja

    // Data Mulai Evaluasi Kinerja
    public function getOpdDataEvaluasi(Request $request)
    {   
        $jml_progress = Lhe::with('opd')
                        ->selectRaw('opd_id, SUM(progres) as total_progres')
                        ->groupBy('opd_id')
                        ->get();
        $jml_lhe = Lhe::groupBy('opd_id')->selectRaw('opd_id, COUNT(*) as total_lhe')->get();

        // Menggabungkan data jml_progress dan jml_lhe
        $data_opd = $jml_progress->map(function($item) use ($jml_lhe) {
            $lhe = $jml_lhe->firstWhere('opd_id', $item->opd_id);
            $item->average_progress = $lhe ? round($item->total_progres / $lhe->total_lhe, 2) : 0;
            return $item;
        });

        // begin::get data using yajra
        if($request->ajax()){
            $data = opd::orderBy('urutan')->get()->map(function($item) use ($data_opd) {
                $opd_data = $data_opd->firstWhere('opd_id', $item->id);
                $item->average_progress = $opd_data ? $opd_data->average_progress : 0;
                return $item;
            });
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('total_progres', function ($row) {
                    $progressbar = '
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: '.$row->average_progress.'%;" aria-valuenow="'.$row->average_progress.'" aria-valuemin="0" aria-valuemax="100">'.$row->average_progress.'%</div>
                    </div>
                    ';
                    return $progressbar;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route ('evaluasi.get-data', $row->id).'" class="btn btn-sm btn-light btn-active-light-primary">LIHAT</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action','total_progres'])
                ->make(true);
        }
        // end::get data using yajra
        return view('frontend.evaluasi.evaluasi');
    }

    public function getLheData(Request $request, $opd_id)
    {
        // begin::get data using yajra
        if ($request->ajax()) {
            $data = Lhe::with('opd')->whereOpdId($opd_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    return $actionBtn;
                })
                ->addColumn('bukti_dukung', function ($row) {
                    $buktiDukung = '<a href="' . $row->bukti_dukung . '" class="text-center" target="_blank">
                    Buka Bukti Dukung</a>';
                    return $buktiDukung;
                })
                ->editColumn('rekomendasi_lhe', function ($row) {
                    return '<div style="text-align: justify;">'. nl2br(e($row->rekomendasi_lhe)) . '</div>';
                })
                ->editColumn('tindak_lanjut', function ($row) {
                    return '<div style="text-align: justify;">'. nl2br(e($row->tindak_lanjut))  .'</div>';
                })
                ->rawColumns(['action','bukti_dukung','rekomendasi_lhe','tindak_lanjut'])
                ->make(true);
        }
        $lhe = Lhe::whereOpdId($opd_id)->get();
        $opd = opd::findOrFail($opd_id);
        return view('frontend.evaluasilhe.lhe', compact('lhe', 'opd'));
    }
    // Data Selesai Evaluasi Kinerja
}