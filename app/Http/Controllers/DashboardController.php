<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the main dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function adminDashboard()
    // {
    //     // Check if the user is authenticated and is an admin
    //     // if (Auth::check() && Auth::user()->is_admin) {
    //         return view('admin-dashboard-marcomm');
    //     // }
    //     // return redirect()->route('dashboard')->withErrors('You do not have access to the admin dashboard.');
    // }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect()->route('signin')->withErrors('You must be logged in to access the dashboard.');
    }
   
}
