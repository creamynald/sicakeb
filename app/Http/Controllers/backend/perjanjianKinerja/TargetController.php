<?php

namespace App\Http\Controllers\backend\perjanjianKinerja;

use App\Http\Controllers\Controller;
use App\Models\PerjanjianKinerja\Realisasi;
use App\Models\PerjanjianKinerja\Target;
use Illuminate\Support\Facades\Validator;
use App\Models\Opd\Kegiatan;
use App\Models\Opd\Program;
use App\Models\Opd\Subkegiatan;
use Illuminate\Http\Request;
use App\Models\Opd\Pegawai;
use App\Models\opd;
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
        $validationRules = [
            'tahun' => 'required|numeric',
            'jenis_master' => 'required|alpha',
            'master_id' => 'required|numeric',
            'sasaran' => 'required|string',
            'indikator' => 'required|string',
            'tw1' => 'nullable|string',
            'tw2' => 'nullable|string',
            'tw3' => 'nullable|string',
            'tw4' => 'nullable|string',
            'satuan' => 'required|string',
            'target_kinerja_tahunan' => 'required|string',
        ];

        $customMessages = [
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'jenis_master.required' => 'Jenis Master tidak boleh kosong',
            'jenis_master.alpha' => 'Jenis Master harus berupa teks huruf',
            'master_id.required' => 'Program/Kegiatan/Sub Kegiatan tidak boleh kosong',
            'sasaran.required' => 'Sasaran tidak boleh kosong',
            'sasaran.string' => 'Sasaran harus berupa string',
            'indikator.required' => 'Indikator tidak boleh kosong',
            'indikator.string' => 'Indikator harus berupa string',
            'tw1.string' => 'Triwulan I harus berupa huruf, angka dan tanda penghubung(-)',
            'tw2.string' => 'Triwulan II harus berupa huruf, angka dan tanda penghubung(-)',
            'tw3.string' => 'Triwulan III harus berupa huruf, angka dan tanda penghubung(-)',
            'tw4.string' => 'Triwulan IV harus berupa huruf, angka dan tanda penghubung(-)',
            'satuan.required' => 'Satuan Kinerja tidak boleh kosong',
            'satuan.string' => 'Satuan Kinerja harus berupa string',
            'target_kinerja_tahunan.required' => 'Target Kinerja Tahunan tidak boleh kosong',
            'target_kinerja_tahunan.string' => 'Target Kinerja Tahunan harus berupa string',

        ];

        $validator = Validator::make($request->all(), $validationRules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $anggaran = explode(",",$request->anggaran); //memecah angka jika terdapat koma pada bilangan ribuan
        $a = implode($anggaran); //menyatukan kembali menjadi angka utuh tanpa koma

        $target = Target::find($request->dataId);
        if($target){
            $request->request->remove('parent_id');
            $request->request->remove('has_child');
        }

        $request->request->add(['anggaran'=>$a]);

        $data = Target::updateOrCreate(
            ['id' => $request->dataId],
            $request->all()
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
        Realisasi::where('target_id', $id)->delete();
        $item->delete();
        return response()->json(['success' => true]);
    }


    public function getData(Request $request)
    {
        $jenis_master = $request->jenis_master;

        switch ($jenis_master) {
            case 'program':
                $data = Program::withWhereHas('sasaran.tujuan', function($q) {
                    $q->where('opd_id', auth()->user()->opd_id);
                })->get();
                break;
            case 'kegiatan':
                $data = Kegiatan::tujuan()->get();
                break;
            case 'subkegiatan':
                $data = Subkegiatan::tujuan()->get();
                break;
            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }
}
