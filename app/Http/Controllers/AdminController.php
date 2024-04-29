<?php

namespace App\Http\Controllers;

use App\Models\DormCart;
use App\Models\Gym;
use App\Models\GymCart;
use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gymsPendingCount = Gym::where('status', 'Pending')->count();
        $dormsPendingCount = Dorm::where('status', 'Pending')->count();
        $totalPendingCount = $gymsPendingCount + $dormsPendingCount;

        $gymsForPaymentCount = Gym::where('status', 'For Payment')->count();
        $dormsForPaymentCount = Dorm::where('status', 'For Payment')->count();
        $totalForPaymentCount = $gymsForPaymentCount + $dormsForPaymentCount;

        $gymsReservedCount = Gym::where('status', 'Reserved')->count();
        $dormsReservedCount = Dorm::where('status', 'Reserved')->count();
        $totalReservedCount = $gymsReservedCount + $dormsReservedCount;
        
        return view('admin.admindashboard', [
            'gymsPendingCount' => $gymsPendingCount, 
            'dormsPendingCount' => $dormsPendingCount, 
            'totalPendingCount' => $totalPendingCount,
            'gymsForPaymentCount' => $gymsForPaymentCount, 
            'dormsForPaymentCount' => $dormsForPaymentCount, 
            'totalForPaymentCount' => $totalForPaymentCount,
            'gymsReservedCount' => $gymsReservedCount, 
            'dormsReservedCount' => $dormsReservedCount, 
            'totalReservedCount' => $totalReservedCount
        ]);
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
        $gyms = Gym::all();
        $carts = GymCart::all();
        
        return view('admin.admingym', ['gyms' => $gyms, 'carts' => $carts]);
    }
    
    public function dorm()
    {
        $dorms = Dorm::all();
        $carts = DormCart::all();
        
        return view('admin.admindorm', ['dorms' => $dorms, 'carts' => $carts]);
    }
    public function profile()
    {
        return view('admin.adminprofile');
    }

    public function showUser()
    {
       
    }
}
