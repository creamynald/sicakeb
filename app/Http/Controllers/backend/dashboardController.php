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
use App\Models\PerjanjianKinerja\Target;
use App\Models\PerjanjianKinerja\Realisasi;
use DataTables;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        $opd_id = auth()->user()->opd_id;

        // Get user online
        $onlineUsers = User::where('last_login_at', '>=', Carbon::now()->subMinutes(5))->get();
        $allUsersSorted = User::orderBy('last_login_at', 'desc')->get();
        // Tambahkan properti is_online ke setiap pengguna
        $allUsersSorted->map(function ($user) use ($onlineUsers) {
            $user->is_online = $onlineUsers->contains('id', $user->id);
            return $user;
        });
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

    public function rekapCapaianOpd(){
        if (isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }
        else{
            $tahun = date('Y');
        }

        $opdId = auth()->user()->opd_id;

        $target = Target::join('pegawais', 'targets.pegawai_id', '=', 'pegawais.id')
            ->where('pegawais.opd_id', $opdId)
            ->where(function($query) {
                $query->whereNull('targets.jenis_child')
                    ->orWhere('targets.jenis_child', 'indikator');
            })
            ->where('targets.tahun', $tahun)
            ->orderBy('pegawais.eselon') // Sort by eselon
            ->select('targets.*') // Select only columns from target
            ->get();

        $realisasi = new Realisasi();
        return view('backend.capaian.index1',compact('target', 'realisasi'));
    }

    public function rekapCapaianPemda(Request $request){
        if ($request->ajax()) {
            // BUTUH KOREKSI UNTUK KEMUDIAN HARI KETIKA OPERATOR OPD TELAH DIBUAT MAKA HARUS ADA KONDISI WHERE UNTUK MENAMPILKAN DATA SESUAI YANG LOGIN
            $data = Opd::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="' . route('capaianPemdaById', $row->id) . '" class="btn btn-sm btn-light btn-active-light-primary">Rincian</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.capaian.indexRekapPemda');
    }

    public function getCapaianPemdaById($opdId){
        if (isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }
        else{
            $tahun = date('Y');
        }

        $target = Target::join('pegawais', 'targets.pegawai_id', '=', 'pegawais.id')
            ->where('pegawais.opd_id', $opdId)
            ->where(function($query) {
                $query->whereNull('targets.jenis_child')
                ->orWhere('targets.jenis_child', 'indikator');
            })
            ->where('targets.tahun', $tahun)
            ->orderBy('pegawais.eselon') // Sort by eselon
            ->select('targets.*') // Select only columns from target
            ->get();

        $realisasi = new Realisasi();
        $opd = opd::where('id', $opdId)->first();
        return view('backend.capaian.rekapCapaianPemda',compact('target', 'realisasi', 'opd'));
    }

    // MENGHITUNG RATA RATA CAPAIAN ESELON II UNTUK KEBUTUHAN BUPATI
    public function rekapCapaianEselon2(){
        // Get Tahun
        if (isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }
        else{
            $tahun = date('Y');
        }
        // Fetch all OPDs
        $opds = opd::all();

        // Initialize an array to store average capaian for each OPD
        $opdAverages = [];
        foreach ($opds as $opd) {
            // Fetch targets grouped by OPD
            $targets = Target::join('pegawais', 'targets.pegawai_id', '=', 'pegawais.id')
                ->where('pegawais.opd_id', $opd->id)
                ->where(function($query) {
                    $query->where('pegawais.eselon', 'II')
                    ->orWhere('pegawais.kepala_opd', '1');
                })
                ->where(function($query) {
                    $query->whereNull('jenis_child')
                        ->orWhere('jenis_child', 'indikator');
                })
                ->where('targets.tahun', $tahun)
                ->get(['targets.*']); // Ensure we're getting targets columns

            $totalCapaian = 0;
            $jumlahItem = 0;

            foreach ($targets as $target) {
                $realisasi = Realisasi::where('target_id', $target->id)->first();

                if ($realisasi) {
                    $capaian = null;

                    if ($realisasi->capaian != null && $realisasi->capaian != '-' && $realisasi->capaian != 0) {
                        $capaian = $realisasi->capaian;
                    } else {
                        if (is_numeric($target->target_kinerja_tahunan)) {
                            $tw1 = $realisasi->tw1 ?? 0;
                            $tw2 = $realisasi->tw2 ?? 0;
                            $tw3 = $realisasi->tw3 ?? 0;
                            $tw4 = $realisasi->tw4 ?? 0;

                            $tw1 = ($tw1 === null || $tw1 === '-' || $tw1 === '') ? 0 : $tw1;
                            $tw2 = ($tw2 === null || $tw2 === '-' || $tw2 === '') ? 0 : $tw2;
                            $tw3 = ($tw3 === null || $tw3 === '-' || $tw3 === '') ? 0 : $tw3;
                            $tw4 = ($tw4 === null || $tw4 === '-' || $tw4 === '') ? 0 : $tw4;

                            if (is_numeric($tw1) && is_numeric($tw2) && is_numeric($tw3) && is_numeric($tw4)) {
                                $capaian = round(($tw1 + $tw2 + $tw3 + $tw4) / $target->target_kinerja_tahunan * 100, 2);
                            }
                        }else{
                            $capaian = 0;
                        }
                    }

                    if ($capaian !== null) {
                        $totalCapaian += $capaian;
                        $jumlahItem++;
                    }
                }
            }

            // Calculate the average capaian for the OPD
            $averageCapaian = ($jumlahItem > 0) ? round($totalCapaian / $jumlahItem, 2) : 0;
            $opdAverages[$opd->nama] = $averageCapaian;
            // end
        }
        return view('backend.capaian.rekapCapaianEselon2', compact('opds', 'opdAverages', 'tahun'));
    }
    // BATAS RATA-RATA CAPAIAN ESELON II UNTUK KEBUTUHAN BUPATI
}
