<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use DataTables;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index()
    {

        return view('backend.dashboard');
    }

    public function getActivities(Request $request)
    {
        $query = Activity::with('user');

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

        return DataTables::of($query)
        ->addColumn('row_number', function ($activity) {
            // Generate row number by incrementing a counter
            static $counter = 0;
            $counter++;
            return $counter;
        })
            ->addColumn('user_name', function ($activity) {
                return $activity->user ? $activity->user->name : 'guest';
            })
            ->addColumn('properties', function ($activity) {
                return json_encode($activity->properties->toArray());
            })
            ->addColumn('time', function ($activity) {
                return json_encode($activity->properties->toArray());
            })
            ->addColumn('time', function ($activity) {
                return Carbon::parse($activity->created_at)->isoFormat('dddd, D MMM Y');
            })
            ->make(true);
    }
}
