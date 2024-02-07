<?php

namespace App\Http\Controllers\backend\rolesAndPermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rolesController extends Controller
{
    public function index()
    {
        return view('backend.rolesAndPermission.roles.index');
    }
}
