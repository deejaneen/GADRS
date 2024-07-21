<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        if (!$dorm->Form_number) {
            // Validate input
            $validated = request()->validate([
                'Form_number' => 'required|min:3|max:7|unique:dorm_reservations,Form_number,' . $dorm->id,
                'status' => 'required',
                'receiver_name' => 'required',
            ]);
        } else {
            $reservationsNotSimilarToOriginal = Dorm::where('Form_number', '!=', $dorm->Form_number)
                ->get();

            $validated = request()->validate([
                'Form_number' => [
                    'required',
                    'min:3',
                    'max:7',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->Form_number === $value) {
                                $fail('The Form number has already been taken.');
                            }
                        }
                    },
                ],
                'status' => 'required',
                'receiver_name' => 'required',
            ]);
        }


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
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $dorm->employee_id)
            ->first();
        $receivingUser = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', Auth::id())
            ->first();
        // You can return the modal content as a view
        return view('ras.supply.supply-addnumber', compact('dorm', 'userDetails', 'receivingUser'));
    }

    public function viewDorm(Dorm $dorm)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $dorm->employee_id)
            ->first();
        return view('ras.supply.supply-view-gym', compact('dorm', 'userDetails'));
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

        // Generate the filename based on the dorm's Form_number and updated_at timestamp
        $filename = $dorm->Form_number . '_' . $dorm->updated_at->format('Y-m-d') . '_dorm-reservation.pdf';

        $pdf = PDF::loadView('pdf.DormReservationFormSheet1', $data)->setOptions($options);

        return $pdf->stream($filename);
    }
    public function profile()
    {
        return view('ras.supply.supplyprofile');
    }
    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the one provided
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->route('supplyprofile')->with('success', 'Password updated successfully.');
    }
}
