<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


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
        $today = now()->startOfDay();
        $dorms = Dorm::where('status', 'Pending')
            ->where('reservation_end_date', '>=', $today)
            ->orderBy('created_at', 'desc')
            ->get();
        // $dorms = Dorm::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
        return view('ras.supply.supply-dorm-reservations', ['dorms' => $dorms]);
    }


    public function supplyReservationsReceived()
    {
        $today = now()->startOfDay();
        $dorms = Dorm::where('status', 'Received')
            ->where('reservation_end_date', '>=', $today)
            ->orderBy('created_at', 'desc')
            ->get();
        // $dorms = Dorm::where('status', 'Received')->orderBy('created_at', 'DESC')->get();
        return view('ras.supply.supply-dormreservations-received', ['dorms' => $dorms]);
    }
    public function supplyPaid()
    {
        $dorms = Dorm::where('status', 'Reserved')->orderBy('created_at', 'DESC')->get();
        return view('ras.supply.supplypaid', ['dorms' => $dorms]);
    }

    public function addFormNumber(Dorm $dorm)
    {
       
        if (!$dorm->Form_number) {
            // Validate input
            $validated = request()->validate([
                'Form_number' => 'required|min:3|max:11|unique:dorm_reservations,Form_number,' . $dorm->id,
            ]);

            // Concatenate fixed year and month with form number
            // $validated['Form_number'] = $fixedYearMonth . $validated['Form_number'];
        } else {
            $reservationsNotSimilarToOriginal = Dorm::where('Form_number', '!=', $dorm->Form_number)
                ->get();

            $validated = request()->validate([
                'Form_number' => [
                    'required',
                    'min:3',
                    'max:11',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->Form_number === $value) {
                                $fail('The Form number has already been taken.');
                            }
                        }
                    },
                ],
            ]);

            // Concatenate fixed year and month with form number
            // $validated['Form_number'] = $fixedYearMonth . $validated['Form_number'];
        }

        // Update the user with the validated data
        $dorm->update($validated);

        if ($dorm->Form_number) {
            // Redirect with success message
            return redirect()->route('supplypaid')->with('success', 'Form Number added successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('supplypaid')->with('success', 'Form Number not added.');
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
        //  $formNumberInput = Str::afterLast($dorm->Form_number, '-');
        // You can return the modal content as a view
        return view('ras.supply.supply-updatestatuspending', compact('dorm', 'userDetails', 'receivingUser'));
    }

    public function changeStatusToReceiveDorm(Dorm $dorm)
    {
        $validated = request()->validate([
            'status' => 'required',
            'receiver_name' => 'required',
        ]);

        // Update the user with the validated data
        $dorm->update($validated);

        // Check if status is "Received"
        if ($dorm->status === 'Received') {
            // Redirect with success message
            return redirect()->route('supplyreservationsrd')->with('success', 'Status changed successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('supplyreservations')->with('success', 'Reservation is updated, status is not Received.');
        }
    }
    public function addORNumberView(Dorm $dorm)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $dorm->employee_id)
            ->first();
        // $receivingUser = User::select('first_name', 'middle_name', 'last_name')
        //     ->where('id', Auth::id())
        //     ->first();
        //  $formNumberInput = Str::afterLast($dorm->Form_number, '-');
        // You can return the modal content as a view
        return view('ras.supply.supply-add-or-number', compact('dorm', 'userDetails'));
    }

    public function addORNumber(Dorm $dorm)
    {
        $currentYearMonth = date('Y-m');

        if (!$dorm->or_number) {
            $validated = request()->validate([
                'or_number' => 'required|min:3|max:11|unique:dorm_reservations,or_number,' . $dorm->id,
                'amount_paid' => 'required|min:3|max:12',
                'status' => 'required',
                'or_date' => 'required|date',
                'cashier_name' => 'required',
            ]);
            // $validated['or_number'] = $currentYearMonth . '-' . $validated['or_number'];
        } else {
            $reservationsNotSimilarToOriginal = Dorm::where('or_number', '!=', $dorm->or_number)->get();
            $validated = request()->validate([
                'or_number' => [
                    'required',
                    'min:3',
                    'max:11',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal, $currentYearMonth) {
                        $valueWithDate = $currentYearMonth . '-' . $value;
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->or_number === $valueWithDate) {
                                $fail('The OR Number has already been taken.');
                            }
                        }
                    },
                ],
                'cashier_name' => 'required',
                'amount_paid' => 'required|min:3|max:12',
                'status' => 'required',
                'or_date' => 'required|date',
            ]);
        }

        if ($validated['status'] === 'Reserved') {
            $startDate = new \DateTime($dorm->reservation_start_date);
            $endDate = new \DateTime($dorm->reservation_end_date);
            $endDate->modify('+1 day');
            $interval = \DateInterval::createFromDateString('1 day');
            $dateRange = new \DatePeriod($startDate, $interval, $endDate);

            foreach ($dateRange as $date) {
                $bed = DB::table('beds')
                    ->where('date', $date->format('Y-m-d'))
                    ->where('gender', $dorm->gender)
                    ->first();

                if ($bed && $bed->availability < $dorm->quantity) {
                    Session::flash('error', 'Insufficient bed availability on ' . $date->format('Y-m-d'));
                    return redirect()->back();
                }
            }
        }

        $dorm->update($validated);

        if ($dorm->status === 'Reserved') {
            // Calculate the total reservation days
            $startDate = new \DateTime($dorm->reservation_start_date);
            $endDate = new \DateTime($dorm->reservation_end_date);
            $endDate->modify('+1 day'); // Include the end date in the range
            $interval = \DateInterval::createFromDateString('1 day');
            $dateRange = new \DatePeriod($startDate, $interval, $endDate);

            // Get all rows with status of Pending and Received
            $dormReservationsPendingAndReceived = Dorm::whereIn('status', ['Pending', 'Received'])->get();

            // Check availability for each date in the reservation period
            foreach ($dateRange as $date) {
                $bed = DB::table('beds')
                    ->where('date', $date->format('Y-m-d'))
                    ->where('gender', $dorm->gender)
                    ->first();

                // Update the status to Cancelled for the reservations with insufficient availability
                foreach ($dormReservationsPendingAndReceived as $reservation) {
                    // Check if the bed availability is less than the quantity of reservations
                    if ($bed && $bed->availability < $reservation->quantity) {
                        $reservation->status = "Cancelled";
                        $reservation->save();
                    }
                }
            }
            // Redirect with success message
            return redirect()->route('supplypaid')->with('success', 'Reservation updated successfully!');
        } else {
            return redirect()->route('supplyreservationsrd')->with('success', 'Reservation updated successfully, status is not Paid.');
        }
    }

    public function addFormNumberPaid(Dorm $dorm)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $dorm->employee_id)
            ->first();
        // $receivingUser = User::select('first_name', 'middle_name', 'last_name')
        //     ->where('id', Auth::id())
        //     ->first();
         $formNumberInput = Str::afterLast($dorm->Form_number, '-');
        // You can return the modal content as a view
        return view('ras.supply.supply-add-form-number', compact('dorm', 'userDetails', 'formNumberInput'));
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
            ->select(DB::raw('DATEDIFF(reservation_end_date, reservation_start_date) as num_days'))
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
