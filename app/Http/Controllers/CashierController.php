<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.cashierdashboard');
    }
    public function test()
    {
        return view('cashier.test');
    }
    public function users()
    {
        return view('cashier.cashieruser');
    }
    public function reservations()
    {
        return view('cashier.cashierreservation');
    }
    public function gym()
    {
        return view('cashier.cashiergym');
    }
    public function dorm()
    {
        return view('cashier.cashierdorm');
    }
    public function profile()
    {
        return view('cashier.cashierprofile');
    }
}
