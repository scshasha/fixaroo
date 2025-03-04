<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            return redirect('/admin');
        } elseif (Auth::user()->is_admin == 2) {
            return redirect('/dashboard');
        }

        dd(Auth::user()->is_admin);

        return view('home');
    }

    public function administratorDashboard()
    {
        if (Auth::user()->is_admin === 1) {
            return view('dashboard');
        }
    }

    public function agentDashboard()
    {
        if (Auth::user()->is_admin === 2) {
            return view('agent-dashboard');
        }
    }
}
