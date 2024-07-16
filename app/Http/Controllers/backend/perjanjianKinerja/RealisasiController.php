<?php

namespace App\Http\Controllers\backend\perjanjianKinerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PerjanjianKinerja\Realisasi;
use App\Models\PerjanjianKinerja\Target;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use App\Models\Opd\Kegiatan;
use App\Models\Opd\Subkegiatan;
use App\Models\Opd\Program;
use DataTables;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        // begin::get data using yajra
        if($request->ajax()){
            // BUTUH KOREKSI UNTUK KEMUDIAN HARI KETIKA OPERATOR OPD TELAH DIBUAT MAKA HARUS ADA KONDISI WHERE UNTUK MENAMPILKAN DATA SESUAI YANG LOGIN
            $data = Pegawai::with('opd')->whereOpdId(auth()->user()->opd_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="'.route('rincianRealisasi',$row->id).'" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        $pegawai = Pegawai::whereOpdId(auth()->user()->opd_id)->get();
        $opd = opd::get();
        return view('backend.realisasi.index', compact('opd','pegawai'));
    }


    public function rincianRealisasi(Request $request, $id)
    {
        // if($request->ajax()){
        //     $data = Target::with('pegawai')->latest()->get();
        //     return DataTables::of($data)
        //     ->addColumn('action', function($row){
        //         $actionBtn = '
        //         <div class="d-flex justify-content-end flex-shrink-0">
        //             <button data-id="'.$row->id.'" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
        //                 <i class="ki-duotone ki-pencil fs-2">
        //                     <span class="path1"></span>
        //                     <span class="path2"></span>
        //                 </i>
        //             </button>
        //         </div>';
        //         return $actionBtn;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);

        // }

        // Check eselon yang muncul
        // $data_eselon = Pegawai::select('eselon')->findOrFail($id);

        // Jika 2 maka akan menampilkan data Program
        // if ($data_eselon->eselon == 'II') {
        //     $data_pk = Program::withWhereHas('sasaran.tujuan', function($q){
        //         $q->where('opd_id', auth()->user()->opd_id);
        //     })->get();
        //     $jenis_master = 'program';
        //     // Jika 3 maka akan menampilkan data Kegiatan
        // } elseif ($data_eselon->eselon == 'III') {
        //     $data_pk = Kegiatan::tujuan()->get();
        //     $jenis_master = 'kegiatan';
        //     // Jika 4 maka akan menampilkan data Subkegiatan
        // } else {
        //     $data_pk = Subkegiatan::withWhereHas('kegiatan.program.sasaran.tujuan', function($q){
        //         $q->where('opd_id', auth()->user()->opd_id);
        //     })->get();
        //     $jenis_master = 'subkegiatan';
        // }
        $tahun = $_GET['tahun'] ?? date("Y");
        $target = Target::wherePegawaiId($id)->where('tahun', $tahun)->get();
        $realisasi = new Realisasi;
        $pegawai = Pegawai::findOrFail( $id );
        return view('backend.realisasi.rincian', compact('target','pegawai','realisasi'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show the data based on id by clicking on edit button
        $data = Realisasi::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        // dd($request->all());

        $validationRules = [
            'target_id' => 'required|numeric',
            'tw1' => 'required|string',
            'tw2' => 'nullable|string',
            'tw3' => 'nullable|string',
            'tw4' => 'nullable|string',
            'pendukung' => 'nullable|string',
            'penghambat' => 'nullable|string',
            'solusi' => 'nullable|string',
            'capaian' => 'nullable|string',
            'realisasi_manual' => 'nullable|string',
        ];

        $customMessages = [
            'target_id.required' => 'Target id tidak boleh kosong',
            'target_id.numeric' => 'Target id harus berupa angka',
            'tw1.required' => 'Triwulan I tidak boleh kosong',
            'tw1.string' => 'Triwulan I harus berupa huruf, angka dan tanda penghubung(-)',
            'tw2.string' => 'Triwulan II harus berupa huruf, angka dan tanda penghubung(-)',
            'tw3.string' => 'Triwulan III harus berupa huruf, angka dan tanda penghubung(-)',
            'tw4.string' => 'Triwulan IV harus berupa huruf, angka dan tanda penghubung(-)',
            'pendukung.string' => 'Pendukung harus berupa string',
            'penghambat.string' => 'Penghambat harus berupa string',
            'solusi.string' => 'Solusi harus berupa string',
            'capaian.string' => 'Capaian harus berupa string',
            'realisasi_manual.string' => 'Realisasi harus berupa string',

        ];

        $validator = Validator::make($request->all(), $validationRules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $realisasi_anggaran = explode(",",$request->realisasi_anggaran); //memecah angka jika terdapat koma pada bilangan ribuan
        $a = implode($realisasi_anggaran); //menyatukan kembali menjadi angka utuh tanpa koma

        $data = Realisasi::updateOrCreate(
            ['id' => $request->dataId],
            [
                'target_id' => $request->target_id,
                'tw1' => $request->tw1,
                'tw2' => $request->tw2,
                'tw3' => $request->tw3,
                'tw4' => $request->tw4,
                'realisasi_anggaran' => $a,
                'pendukung' => $request->pendukung,
                'penghambat' => $request->penghambat,
                'solusi' => $request->solusi,
                'capaian' => $request->capaian,
                'realisasi_manual' => $request->realisasi_manual
            ]
        );
        return response()->json($data);
    }
    // end::additional method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete data by id
        $item = Realisasi::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }


    public function capaian(){
        $data_pegawai = Pegawai::whereOpdId(auth()->user()->opd_id)->orderBy('eselon', 'ASC')->get();
        // Extracting IDs from $data_pegawai collection
        $pegawai_ids = $data_pegawai->pluck('id')->toArray();
        $year = isset($_GET['periode']) ? $_GET['periode'] : date('Y');

        $target = Target::whereIn('pegawai_id', $pegawai_ids)->whereTahun($year)->get();
        $realisasi = new Realisasi;
        return view('backend.capaian.index', compact('target', 'realisasi'));
    }
}
