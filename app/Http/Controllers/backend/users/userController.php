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

    public function editProfile(User $user)
    {
        return view('backend.users.settings.index', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        // Define validation rules for the main fields
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB Max
        ];

        // Check if the name, email, or avatar fields are being changed
        if (
            $request->name != $user->name || $request->email != $user->email || $request->hasFile('avatar')) {
            $validationRules['current_password'] = 'required|string|min:8';
        }

        // Add rules for password update if needed
        if ($request->filled('new_password')) {
            $validationRules['new_password'] = 'required|string|min:8|different:current_password';
            $validationRules['new_password_confirmation'] = 'required|same:new_password';
        }

        // Perform validation
        $validatedData = $request->validate($validationRules);

        // Ensure current password is provided before allowing sensitive updates
        if (isset($validatedData['current_password'])) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
        } else {
            // If the password is required but not provided or correct
            return back()->with('error', 'Password is required to update name, email, or avatar.');
        }

        // Process avatar if provided
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::delete('avatars/' . $user->avatar);
            }

            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'local'); // Ensure 'local' is correctly configured
            $user->avatar = basename($avatarPath);
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->last_login_at = now();
        $user->last_login_ip = $request->ip();

        // Update password if a new one is provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
