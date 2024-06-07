<?php

namespace App\Http\Controllers\backend\dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen\file;
use DataTables;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Jika permintaan adalah AJAX, kembalikan data dalam format DataTables
        if ($request->ajax()) {
            $data = file::select(['id', 'nama', 'lokasi_file', 'tahun']);

            return fileTable::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $folder = strtolower($row->jenis_file);
                    $filename = basename($row->lokasi_file);
        
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <button data-id="' . $row->id . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <button onclick="deleteItem(' . $row->id . ', \'' . $folder . '\', \'' . $filename . '\')" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
                ->addColumn('lokasi_file', function ($row) {
                    // Get the file location from the database
                    $lokasi_file = $row->lokasi_file;
                    // Determine the folder based on jenis_file
                    $folder = strtolower($row->jenis_file); // Convert to lowercase to standardize folder names
                    // Set the complete path in the 'local' disk
                    $path = "dokumen/{$folder}/" . basename($lokasi_file);
        
                    // Check if the file exists
                    if ($lokasi_file && Storage::disk('local')->exists($path)) {
                        // Generate download link
                        return '<a href="' . route('download', ['filename' => $path]) . '" class="text-info" target="_blank">
                                <i class="ki-duotone ki-download fs-2"></i></a>';
                    } else {
                        return 'File Tidak Ditemukan';
                    }
                })
                ->rawColumns(['action', 'lokasi_file'])
                ->make(true);
        }
        
        // Memeriksa peran pengguna saat ini dan menyaring data berdasarkan opd_id jika pengguna bukan admin, Super-Admin, atau operator
        $query = file::with('opd')->latest();

        if (!auth()->user()->hasAnyRole(['admin', 'Super-Admin'])) {
        // Jika pengguna bukan admin atau Super-Admin, filter berdasarkan opd_id
            $query->where('opd_id', auth()->user()->opd_id);
        }

        // Memeriksa apakah parameter jenis_file ada dalam permintaan dan tidak kosong, lalu menambahkan kondisi ke query
        if ($request->has('jenis_file') && !empty($request->jenis_file)) {
            $query->where('jenis_file', $request->jenis_file);
        }

        $data = $query->paginate(1);

        // Mengirim data ke tampilan jika bukan permintaan AJAX
        return view('backend.uploadfile.index', compact('data'));
    }

    public function download($folder,$filename)
    {
        // Set path lengkap di dalam disk 'local'
        $path = "dokumen/".$folder.'/'.$filename;

        // Periksa apakah file ada
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
        $data = file::findOrFail($id);
        return response()->json($data);
    }

    // begin::additional method to add or edit data
    public function saveData(Request $request)
    {
        // Validasi data
        $request->validate([
            'opd_id' => 'required|integer',
            'tahun' => 'required|integer',
            'jenis_file' => 'required|string',
            'nama' => 'required|string|max:255',
            'lokasi_file' => 'required|file|mimes:pdf,doc,docx|max:30000000',
        ]);

        if ($request->hasFile('lokasi_file')) {
            $doc = $request->file('lokasi_file');

            // Tentukan folder berdasarkan jenis_file
            $folder = strtolower($request->jenis_file); // convert to lowercase to standardize the folder names
            $path = $doc->store("dokumen/{$folder}");

            $data = File::updateOrCreate(
                ['id' => $request->dataId],
                [
                    'opd_id' => $request->opd_id,
                    'tahun' => $request->tahun,
                    'jenis_file' => $request->jenis_file,
                    'nama' => $request->nama,
                    'lokasi_file' => $path,
                ]
            );

            return response()->json($data);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

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
    public function destroy($id, $folder, $filename)
    {
        // Path to the storage folder
        $path = "dokumen/" . $folder . '/' . $filename;

        // Check if the file exists
        if (Storage::disk('local')->exists($path)) {
            // Delete the file from storage
            Storage::disk('local')->delete($path);

            // Find and delete the record from the database
            $item = file::findOrFail($id);
            if ($item) {
                // Delete the record from the database
                $item->delete();
                return redirect()->back()->with('success', 'Data berhasil dihapus.');
            } else {
                // Record not found in the database
                return redirect()->back()->with('error', 'Record not found.');
            }
        } else {
            // File not found in storage
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}