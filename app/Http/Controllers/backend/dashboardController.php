<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\opd;
use App\Models\Opd\Kegiatan;
use App\Models\Opd\Pegawai;
use App\Models\Opd\Program;
use App\Models\Opd\Sasaran;
use App\Models\Opd\Subkegiatan;
use App\Models\Opd\Tujuan;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        $opd_id = auth()->user()->opd_id;

        // Get user online
        $onlineUsers = User::where('last_login_at', '>=', Carbon::now()->subMinutes(5))->get();
        $allUsers = User::all();

        $allUsersSorted = $allUsers->map(function ($user) use ($onlineUsers) {
            $user->is_online = $onlineUsers->contains('id', $user->id);
            return $user;
        })->sortByDesc('is_online');
        // end get online user

        $data_opd = opd::count();
        $data_tujuan = Tujuan::whereOpdId($opd_id)->count();
        $data_sasaran = Sasaran::whereHas('tujuan', function ($query) use ($opd_id) {
                            $query->where('opd_id', $opd_id);
                        })->count();
        $data_program = Program::whereHas('sasaran.tujuan', function ($query) use ($opd_id) {
                            $query->where('opd_id', $opd_id);
                        })->count();
        $data_kegiatan = Kegiatan::whereHas('program.sasaran.tujuan', function ($query) use ($opd_id) {
                            $query->where('opd_id', $opd_id);
                        })->count();
        $data_subkegiatan = Subkegiatan::whereHas('kegiatan.program.sasaran.tujuan', function ($query) use ($opd_id) {
                                $query->where('opd_id', $opd_id);
                            })->count();

        // if user login has role Super Admin and Admin
        if (auth()->user()->hasAnyRole(['admin', 'Super-Admin'])) {
            $data_pegawai = Pegawai::get();
        }elseif(auth()->user()->hasAnyRole(['operator'])){ //if user login has role opd
            $data_pegawai = Pegawai::where('opd_id', auth()->user()->opd_id)->get();
        }else{ // if has no role
            abort(403);
        }

        return view('backend.dashboard', compact('onlineUsers', 'data_pegawai', 'data_tujuan', 'data_sasaran', 'data_program', 'data_kegiatan', 'data_subkegiatan', 'data_opd', 'allUsersSorted'));
    }

    public function getActivities(Request $request)
    {
        if (auth()->user()->hasAnyRole(['Super-Admin'])) {

            $query = Activity::with('user')->whereNot('log_name', 'user');

            // Apply filters
            if ($request->filled('day')) {
                $query->whereDay('created_at', $request->day);
            }
            if ($request->filled('month')) {
                $query->whereMonth('created_at', $request->month);
            }
            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }

            if ($request->filled('order_by') && $request->filled('order_direction')) {
                $query->orderBy($request->order_by, $request->order_direction);
            } else {
                // Default ordering
                $query->orderBy('id', 'desc');
            }

            return DataTables::of($query)
            ->addColumn('row_number', function ($activity) {
                // Generate row number by incrementing a counter
                static $counter = 0;
                $counter++;
                return $counter;
            })
            ->addColumn('description', function ($activity) {
                if ($activity->description == 'created') {
                    $description = '<span class="badge badge-light-success fs-base">
                    <i class="ki-outline ki-plus fs-5 text-success ms-n1"></i>Created</span>';
                }elseif ($activity->description == 'updated') {
                    $description = '<span class="badge badge-light-warning fs-base">
                    <i class="ki-outline ki-check fs-5 text-success ms-n1"></i>Updated</span>';
                }else{
                    $description = '<span class="badge badge-light-danger fs-base">
                    <i class="ki-outline ki-minus fs-5 text-success ms-n1"></i>Deleted</span>';
                }
                return $description;
            })
            ->addColumn('user_name', function ($activity) {
                $user_name = '<div class="d-flex justify-content-start flex-column">
                    <a href="#" class="text-gray-800 fw-bold mb-1 fs-6">'.$activity->user->name.'</a>
                    <span class="text-gray-500 fw-semibold d-block fs-7">'.$activity->user->opd?->singkatan.'</span>
                </div>';
                return $user_name;
            })
            ->addColumn('properties', function ($activity) {
                $data = json_decode($activity->properties, true);
                $attributes = isset($data['attributes']) ? $data['attributes'] : [];
                $old = isset($data['old']) ? $data['old'] : [];

                $html = '<ul>';
                foreach ($attributes as $key => $value) {
                    $style = '';
                if (isset($old[$key]) && $old[$key] != $value) {
                    $style = ' class="text-primary"'; // Ganti dengan warna yang diinginkan
                }
                $html .= '<li' . $style . '><strong>' . htmlspecialchars($key) . ':</strong> ' . '&nbsp;' . htmlspecialchars($value) . '</li>';
                }
                $html .= '</ul>';

                return $html;
            })
            ->addColumn('old_data', function ($activity) {
                $data = json_decode($activity->properties, true);
                if ($activity->event == 'updated') {
                    $old = isset($data['old']) ? $data['old'] : [];

                    $html = '<ul>';
                    foreach ($old as $key => $value) {
                        $style = '';
                        if (isset($data['attributes'][$key]) && $data['attributes'][$key] != $value) {
                            $style = ' class="text-danger"'; // Ganti dengan warna yang diinginkan
                        }
                        $html .= '<li' . $style . '><strong>' . htmlspecialchars($key) . ':</strong> ' . '&nbsp;'  . htmlspecialchars($value) . '</li>';
                    }
                    $html .= '</ul>';

                    return $html;
                }elseif($activity->event == 'deleted'){
                    $old = isset($data['old']) ? $data['old'] : [];

                    $html = '<ul>';
                    foreach ($old as $key => $value) {
                        $html .= '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . '&nbsp;' . htmlspecialchars($value) . '</li>';
                    }
                    $html .= '</ul>';

                    return $html;
                }
            })
            ->addColumn('time', function ($activity) {
                return Carbon::parse($activity->created_at)->format('d M Y, H:i:s');
            })
            ->addIndexColumn()
            ->rawColumns(['description', 'user_name', 'properties', 'old_data'])
            ->make(true);
        }else{
            abort(403);
        }
    }
}
