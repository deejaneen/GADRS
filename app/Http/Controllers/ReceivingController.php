<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReceivingController extends Controller
{

    public function index()
    {
        $gymsPendingCount = Gym::where('status', 'Pending')->count();
        $dormsPendingCount = Dorm::where('status', 'Pending')->count();
        $totalReservationCount = $gymsPendingCount + $dormsPendingCount;

        // Get current month's total reservation received
        $currentMonth = date('F'); // Format the current month to display in words
        $currentYear = date('Y');
        $thisMonthGymReceivedCount = Gym::whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ?', [$currentMonth, $currentYear])->count();
        $thisMonthDormReceivedCount = Dorm::whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ?', [$currentMonth, $currentYear])->count();
        $thisMonthTotalReservationReceived = $thisMonthGymReceivedCount + $thisMonthDormReceivedCount;

        // Get last month's total reservation received
        $lastMonth = date('F', strtotime('-1 month')); // Format the last month to display in words
        $lastMonthYear = date('Y', strtotime('-1 month'));
        $lastMonthGymReceivedCount = Gym::whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ?', [$lastMonth, $lastMonthYear])->count();
        $lastMonthDormReceivedCount = Dorm::whereRaw('MONTH(created_at) = ? AND YEAR(created_at) = ?', [$lastMonth, $lastMonthYear])->count();
        $lastMonthTotalReservationReceived = $lastMonthGymReceivedCount + $lastMonthDormReceivedCount;

        return view('ras.receiving.receivingdashboard', [
            'lastMonth' => $lastMonth,
            'currentMonth' => $currentMonth,
            'totalReservationCount' => $totalReservationCount,
            'thisMonthTotalReservationReceived' => $thisMonthTotalReservationReceived,
            'lastMonthTotalReservationReceived' => $lastMonthTotalReservationReceived
        ]);
    }

    public function receivingpending()
    {

        $gymsPendingCount = Gym::where('status', 'Pending')->count();
        $gyms = Gym::where('status', 'Pending')->get();

        return view('ras.receiving.receivingpending', [
            'gymsPendingCount' => $gymsPendingCount,
            'gyms' => $gyms
        ]);
    }
    public function receivingreceived()
    {
        return view('ras.receiving.receivingreceived');
    }
    public function receivingedit()
    {
        return view('ras.receiving.receivingedit');
    }

    public function addFormNumber(Gym $gym)
    {
        // Validate input
        $validated = request()->validate([
            'reservation_number' => 'required|min:3|max:40',
            'status' => 'required',
        ]);

        // Update the user with the validated data
        $gym->update($validated);

        // Redirect back with success message
        return redirect()->route('receivingpending')->with('success', 'Form Number added successfully!');
    }

    public function editGym(Gym $gym)
    {
        // You can return the modal content as a view
        return view('ras.receiving.receiving-addnumber', compact('gym'));
    }

    public function viewGym(Gym $gym){
        return view('ras.receiving.receiving-view-gym', compact('gym'));
    }
}
