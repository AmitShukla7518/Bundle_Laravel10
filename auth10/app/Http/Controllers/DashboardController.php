<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        try {
        return view('dashboard');
    } catch (Exception $e) {
        return back()->with('error', 'Something Went Wrong');
    }
    }
}
