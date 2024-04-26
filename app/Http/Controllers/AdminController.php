<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admindashboard');
    }
    public function test()
    {
        return view('admin.test');
    }
    public function users()
    {
        $users = User::where('role', '!=', 'Admin')->get();
        return view('admin.adminuser', ['users' => $users]);

    }
    public function reservations()
    {
        return view('admin.adminreservation');
    }
    public function gym()
    {
        return view('admin.admingym');
    }
    public function dorm()
    {
        return view('admin.admindorm');
    }
    public function profile()
    {
        return view('admin.adminprofile');
    }

    public function showUser()
    {
       
    }
}
