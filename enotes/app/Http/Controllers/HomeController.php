<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Menghapus akun user secara permanen.
     */
    public function deleteAccount()
    {
        $user = \Auth::user();
        $user->notes()->delete();
        $user->delete();
        \Auth::logout();
        return redirect('/')->with('success', 'Akun Anda telah dihapus permanen. Sampai jumpa!');
    }
}


