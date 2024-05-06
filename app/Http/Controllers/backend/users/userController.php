<?php

namespace App\Http\Controllers\backend\users;

use App\Http\Controllers\Controller;
use App\Models\opd;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('opd', 'roles')->latest()->get();
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
        return view('backend.users.index', [
            'data_opd' => opd::orderBy('id', 'asc')->get(),
            'roles' => Role::latest()->get(),
        ]);
    }

    public function saveData(Request $request)
    {
        $data = User::updateOrCreate(
            ['id' => $request->input('dataId')], // Pastikan menggunakan input untuk mengambil data dari request
            [
                'opd_id' => $request->input('opd_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ],
        );

        // Kondisi jika request role tidak ada, default ke operator
        if (empty($request->input('role'))) {
            $data->assignRole('operator');
        } else {
            $data->syncRoles($request->input('role'));
        }

        return response()->json($data);
    }

    public function show(string $id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }

    public function edit(User $user)
    {
        return view('backend.users.settings.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB Max
            'current_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|different:current_password',
            'new_password_confirmation' => 'nullable|same:new_password',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::delete('avatars/' . $user->avatar);
            }

            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'local'); // Ensure 'local' is correctly configured
            $user->avatar = basename($avatarPath);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->last_login_at = now();
        $user->last_login_ip = $request->ip();

        if ($request->filled('current_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                if ($request->filled('new_password')) {
                    $user->password = Hash::make($request->new_password);
                }
            } else {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
        }

        $user->save();
        
        return back()->with('success', 'Profile updated successfully.');
    }
}
