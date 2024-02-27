<?php

namespace App\Http\Controllers\backend\rolesAndPermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;

class assignRolePermission extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::with('permissions')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <button data-id="' .
                        $row->id .
                        '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                            <i class="ki-duotone ki-arrows-circle fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.rolesAndPermission.assignable.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name');
        return response()->json(['role' => $role, 'rolePermissions' => $rolePermissions]);
    }

    public function saveData(Request $request)
    {
        $role = Role::find($request->role);
        $role->syncPermissions($request->permissions);

        return response()->json(['success' => true]);
    }
}
