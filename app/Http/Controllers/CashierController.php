<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.cashierdashboard');
    }
       public function forpayment()
    {
        return view('cashier.cashierforpayment');
    }
    public function paid()
    {
        return view('cashier.cashierpaid');
    }

}
