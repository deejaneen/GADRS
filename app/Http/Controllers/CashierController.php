<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.cashierdashboard');
    }
    public function forpayment()
    {
        $gyms = Gym::where('status', 'For Payment')->get();
        $dorms = Dorm::where('status', 'For Payment')->get();
        
        return view('cashier.cashierforpayment', ['dorms' => $dorms, 'gyms' => $gyms]);
    }
    
    public function paid()
    {
        return view('cashier.cashierpaid');
    }

}
