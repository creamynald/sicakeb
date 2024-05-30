<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {
        $onlineUsers = User::where('last_login_at', '>=', Carbon::now()->subMinutes(5))->get();

        return view('backend.dashboard', compact('onlineUsers'));
    }

    public function getActivities(Request $request)
    {
        $query = Activity::with('user')->whereNot('log_name','user');

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
                return json_encode($activity->properties->toArray());
            })
            ->addColumn('time', function ($activity) {
                return Carbon::parse($activity->created_at)->format('d M Y, H:i:s');
            })
            ->rawColumns(['description', 'user_name'])
            ->make(true);
    }
}
