<?php

namespace App\Http\Controllers\backend\perjanjianKinerja;

use App\Http\Controllers\Controller;
use App\Models\Opd\Kegiatan;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;
use Illuminate\Http\Request;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use App\Models\PerjanjianKinerja\Target;
use DataTables;


class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                        <a href="'.route('rincianTarget',$row->id).'" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // end::get data using yajra
        $pegawai = Pegawai::get();
        $opd = opd::get();
        return view('backend.target.index', compact('opd','pegawai'));
    }


    public function rincianTarget(Request $request, $id)
    {
        if($request->ajax()){
            $data = Target::with('pegawai')->latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($row){
                $actionBtn = '
                <div class="d-flex justify-content-end flex-shrink-0">
                    <button data-id="'.$row->id.'" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <button onclick="deleteItem('.$row->id.')" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                        <i class="ki-duotone ki-trash fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

        }

        // Check eselon yang muncul
        $data_eselon = Pegawai::select('eselon')->findOrFail($id);

        // Jika 2 maka akan menampilkan data Program
        if ($data_eselon->eselon == 'II') {
            $data_pk = Program::withWhereHas('sasaran.tujuan',function($q){
                $q->where('opd_id', auth()->user()->opd_id);
            })->get();
            $jenis_master = 'program';
            // Jika 3 maka akan menampilkan data Kegiatan
        } elseif ($data_eselon->eselon == 'III') {
            $data_pk = Kegiatan::tujuan()->get();
            $jenis_master = 'kegiatan';
            // Jika 4 maka akan menampilkan data Subkegiatan
        } else {
            $data_pk = Subkegiatan::tujuan()->get();
            $jenis_master = 'subkegiatan';
        }

        $target = Target::wherePegawaiId($id)->where('tahun', date("Y"))->get();
        $pegawai = Pegawai::findOrFail( $id );
        return view('backend.target.rincian', compact('target','pegawai','data_pk','jenis_master'));
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
        $data = Target::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        $anggaran = explode(",",$request->anggaran); //memecah angka jika terdapat koma pada bilangan ribuan
        $a = implode($anggaran); //menyatukan kembali menjadi angka utuh tanpa koma

        $data = Target::updateOrCreate(
            ['id' => $request->dataId],
            [
                'tahun' => $request->tahun,
                'jenis_master' => $request->jenis_master,
                'master_id' => $request->master_id,
                'pegawai_id' => $request->pegawai_id,
                'sasaran' => $request->sasaran,
                'indikator' => $request->indikator,
                'satuan' => $request->satuan,
                'tw1' => $request->tw1,
                'tw2' => $request->tw2,
                'tw3' => $request->tw3,
                'tw4' => $request->tw4,
                'anggaran' => $a,
                'target_kinerja_tahunan' => $request->target_kinerja_tahunan,
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
        $item = Target::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}
