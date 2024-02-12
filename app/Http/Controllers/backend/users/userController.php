<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use App\Models\opd;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('opd')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <button data-id="' .
                        $row->id .
                        '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                            <i class="ki-duotone
                            ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <button onclick="deleteItem(' .
                        $row->id .
                        ')" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                            <i class="ki-duotone
                            ki-trash fs-2">
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
        return view('backend.users.index', [
            'data_opd' => opd::orderBy('id', 'asc')->get(),
        ]);
    }

    public function saveData(Request $request)
    {
        $data = User::updateOrCreate(
            ['id' => $request->dataId],
            [
                'opd_id' => $request->opd_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );
        return response()->json($data);
    }

    public function show(string $id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }
}
