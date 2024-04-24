<?php

namespace App\Http\Controllers\backend\lhe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lhe\Lhe;
use DataTables;

class LheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // begin::get data using yajra
        if ($request->ajax()) {
            if (auth()->user()->hasAnyRole(['admin', 'Super-Admin'])) {
                $data = Lhe::with('opd')->latest()->get();
            } else {
                // if user login has role opd get data pegawai based on opd_id
                $data = Lhe::with('opd')->where('opd_id', auth()->user()->opd_id)->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <button data-id="' . $row->id . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <button onclick="deleteItem(' . $row->id . ')" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
        return view('backend.' . request()->segment(2) . '.index');
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
        $data = Lhe::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        $data = Lhe::updateOrCreate(
            ['id' => $request->dataId],
            [
                'rekomendasi_lhe' => $request->rekomendasi_lhe,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                'tindak_lanjut' => $request->tindak_lanjut,
                'target_penyelesaian' => $request->target_penyelesaian,
                'progres' => $request->progres,
                'bukti_dukung' => $request->bukti_dukung
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
        $item = Lhe::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}
