<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $gymsCount = Gym::where('status', 'For Payment')->count();
        $dormsCount = Dorm::where('status', 'For Payment')->count();
        $gymsCountPaid = Gym::where('status', 'Paid')->count();
        $dormsCountPaid = Dorm::where('status', 'Paid')->count();
        $gymsCountTotal = Gym::all()->count();
        $dormsCountTotal = Dorm::all()->count();
        
        return view('cashier.cashierdashboard', ['gymsCount' => $gymsCount, 'dormsCount' => $dormsCount, 'gymsCountPaid' => $gymsCountPaid, 'dormsCountPaid' => $dormsCountPaid,'gymsCountTotal' => $gymsCountTotal, 'dormsCountTotal' => $dormsCountTotal]);
    }
    public function forpayment()
    {
        $gyms = Gym::where('status', 'For Payment')->get();
        $dorms = Dorm::where('status', 'For Payment')->get();
        
        return view('cashier.cashierforpayment', ['dorms' => $dorms, 'gyms' => $gyms]);
    }
    
    public function paid()
    {
        $gyms = Gym::where('status', 'Paid')->get();
        $dorms = Dorm::where('status', 'Paid')->get();
        
        return view('cashier.cashierpaid', ['dorms' => $dorms, 'gyms' => $gyms]);
    }

}
