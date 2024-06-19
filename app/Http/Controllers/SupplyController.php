<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


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

        // Check if status is "Received"
        if ($dorm->status === 'Received') {
            // Redirect with success message
            return redirect()->route('supplyreservationsrd')->with('success', 'Form Number added successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('supplyreservations')->with('success', 'Form Number updated successfully, status is not Received.');
        }
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

    public function viewDormPDF(Dorm $dorm)
    {
        // Calculate the number of days between reservation_start_date and reservation_end_date
        $numberOfDays = DB::table('dorm_reservations')
            ->where('id', $dorm->id) // Assuming 'id' is the primary key of 'dorm_reservations'
            ->select(DB::raw('DATEDIFF(reservation_end_date, reservation_start_date) + 1 as num_days'))
            ->first();

        // Handle if $numberOfDays is null (handle case where $dorm is not found or dates are not set)
        $numDays = $numberOfDays ? $numberOfDays->num_days : 0;

        $data = [
            'dorm' => $dorm,
            'numberOfDays' => $numDays,
        ];
        $marginInMillimeters = 0.5 * 25.4; // Convert inches to millimeters

        // Pass options for paper size and margins
        $options = [
            'format' => [8.5, 13], // Set the paper size in inches
            'margin_top' => $marginInMillimeters,
            'margin_bottom' => $marginInMillimeters,
            'margin_left' => $marginInMillimeters,
            'margin_right' => $marginInMillimeters,
        ];

        $pdf = PDF::loadView('pdf.DormReservationFormSheet1', $data)->setOptions($options);

        return $pdf->stream('dorm-reservation.pdf');
    }
}
