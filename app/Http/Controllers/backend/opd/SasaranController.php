<?php

namespace App\Http\Controllers\backend\opd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opd\Sasaran;
use App\Models\Opd\Tujuan;
use DataTables;

class SasaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // begin::get data using yajra
        $tujuan = Tujuan::where('opd_id', auth()->user()->opd_id)->first();
        if($request->ajax()){
            if(auth()->user()->hasAnyRole(['admin', 'Super-Admin'])){
                $data = Sasaran::with('tujuan')->latest()->get();
            }else{
                $data = Sasaran::with('tujuan')->whereHas('tujuan', function($q){
                    $q->where('opd_id', auth()->user()->opd_id);
                })->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
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
        // end::get data using yajra
        $tujuan = Tujuan::whereOpdId(auth()->user()->opd_id)->get();
        return view('backend.sasaran.index', compact('tujuan'));
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
        $data = Sasaran::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        $data = Sasaran::updateOrCreate(
            ['id' => $request->dataId],
            [
                'tujuan_id' => $request->tujuan_id,
                'nama' => $request->nama
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
        $item = Sasaran::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}
