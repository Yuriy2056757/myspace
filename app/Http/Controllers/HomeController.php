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
        $allUsers = User::all();
        $userCount = $allUsers->count();

        if ($userCount > 6) {
            $userCount = 6;
        }

        $users = $allUsers->random($userCount);

        return view('home', compact('users'));
    }

    // Show contact page
    public function contact()
    {
        return view('contact');
    }
}