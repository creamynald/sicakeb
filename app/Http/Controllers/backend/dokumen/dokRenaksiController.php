<?php

namespace App\Http\Controllers\backend\dokumen;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\dokRenaksi;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Opd\Pegawai;
use App\Models\opd;
use DataTables;

class dokRenaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (
                auth()
                    ->user()
                    ->hasAnyRole(['Super-Admin'])
            ) {
                $data = dokRenaksi::with('opd')
                    ->orderBy('tahun', 'desc') // Mengurutkan berdasarkan tahun, terbaru di atas
                    ->orderBy('urutan', 'asc') // Mengurutkan berdasarkan urutan, terkecil di atas
                    ->get();
            } else {
                $data = dokRenaksi::with('opd')
                    ->where('opd_id', auth()->user()->opd_id)
                    ->orderBy('tahun', 'desc') // Mengurutkan berdasarkan tahun, terbaru di atas
                    ->orderBy('urutan', 'asc') // Mengurutkan berdasarkan urutan, terkecil di atas
                    ->get();
            }
            \Log::info($data); // Log the data for debugging
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <button data-id="' .
                        $row->id .
                        '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <button onclick="deleteItem(' .
                        $row->id .
                        ')" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
        $opd = opd::get();
        return view('backend.dokRenaksi.index', compact('opd'));
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
    public function show($id)
    {
        $data = dokRenaksi::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        $data = dokRenaksi::updateOrCreate(
            ['id' => $request->dataId],
            [
                'opd_id' => $request->opd_id,
                'tahun' => $request->tahun,
                'urutan' => $request->urutan,
                'link' => $request->link,
            ],
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
        $item = dokRenaksi::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}
