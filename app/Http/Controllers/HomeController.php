<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Retrieve all users
        $users = User::all();

        return view('home', compact('users'));
    }

    // Show contact page
    public function contact()
    {
        return view('contact');
    }
}