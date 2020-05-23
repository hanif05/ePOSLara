<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $session['title'] = 'Dashboard';
        request()->session()->put($session);

        
        return view('admin.dashboard.index');
    }
}
