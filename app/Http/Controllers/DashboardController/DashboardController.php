<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\Employe\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('dashboard');
        return View::make('dashboard');
    }
}
