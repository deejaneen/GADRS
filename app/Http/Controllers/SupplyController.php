<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use Illuminate\Http\Request;


class SupplyController extends Controller
{
    public function index()
    {
        $dormsPendingCount = Dorm::where('status', 'Pending')->count();
        $dormsPendingCountReceived = Dorm::where('status', 'Received')->count();
        return view('ras.supply.supplydashboard', ['dormsPendingCount' => $dormsPendingCount, 'dormsPendingCountReceived' => $dormsPendingCountReceived]);
    }

    public function supplyReservations()
    {
        $dorms = Dorm::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
        return view('ras.supply.supply-dorm-reservations', ['dorms' => $dorms]);
    }


    public function supplyReservationsReceived()
    {
        $dorms = Dorm::where('status', 'Received')->orderBy('created_at', 'DESC')->get();
        return view('ras.supply.supply-dormreservations-received', ['dorms' => $dorms]);
    }

    public function addFormNumber(Dorm $dorm)
    {
        // Validate input
        $validated = request()->validate([
            'Form_number' => 'required|min:3|max:40',
            'status' => 'required',
        ]);



        // Update the user with the validated data
        $dorm->update($validated);
        // Redirect back with success message
        return redirect()->route('supplyreservationsrd')->with('success', 'Form Number added successfully!');
    }


    public function editDorm(Dorm $dorm)
    {
        // You can return the modal content as a view
        return view('ras.supply.supply-addnumber', compact('dorm'));
    }

    public function viewDorm(Dorm $dorm)
    {
        return view('ras.supply.supply-view-gym', compact('dorm'));
    }
}
