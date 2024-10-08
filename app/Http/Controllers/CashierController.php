<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \NumberFormatter;





class CashierController extends Controller
{
    public function index()
    {
        $gymsCount = Gym::where('status', 'Received')->count();
        $dormsCount = Dorm::where('status', 'Received')->count();
        $gymsCountPaid = Gym::where('status', 'Reserved')->count();
        $dormsCountPaid = Dorm::where('status', 'Reserved')->count();
        $gymsCountTotal = Gym::all()->count();
        $dormsCountTotal = Dorm::all()->count();

        return view('cashier.cashierdashboard', ['gymsCount' => $gymsCount, 'dormsCount' => $dormsCount, 'gymsCountPaid' => $gymsCountPaid, 'dormsCountPaid' => $dormsCountPaid, 'gymsCountTotal' => $gymsCountTotal, 'dormsCountTotal' => $dormsCountTotal]);
    }
    public function forpayment()
    {

        $gyms = Gym::where('status', 'Received')->get();
        $dorms = Dorm::where('status', 'Received')->get();

        return view('cashier.cashierforpayment', ['dorms' => $dorms, 'gyms' => $gyms]);
    }

    public function paid()
    {
        $gyms = Gym::where('status', 'Reserved')->get();
        $dorms = Dorm::where('status', 'Reserved')->get();

        return view('cashier.cashierpaid', ['dorms' => $dorms, 'gyms' => $gyms]);
    }

    public function confirmPaymentGym(Gym $gym)
    {
        // Validate input
        if (!$gym->oop_number) {
            // Validate input when conditions are met
            $validated = request()->validate([
                // 'price' => 'required|min:3|max:12',
                'oop_number' => 'required|min:3|max:11|unique:gym-reservations,oop_number,' . $gym->id,
                'or_date' => 'required|date',
                'status' => 'required',
                'cashier_name' => 'required',
            ]);
        } else {
            // Validate input when conditions are not met
            $reservationsNotSimilarToOriginal = Gym::where('form_group_number', '!=', $gym->form_group_number)
                ->get();

            $validated = request()->validate([

                'status' => 'required',
                'cashier_name' => 'required',
                'oop_number' => [
                    'required',
                    'min:3',
                    'max:11',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->oop_number === $value) {
                                $fail('The ' . $attribute . ' has already been taken.');
                            }
                        }
                    },
                ],
                'or_date' => 'required|date',

            ]);
        }



        // Get all Gym reservations with the same form_group_number
        $gymReservations = Gym::where('form_group_number', $gym->form_group_number)->get();

        if (count($gymReservations) > 1) {
            // Update each reservation
            foreach ($gymReservations as $gymReservation) {
                $gymReservation->update([
                    'status' => $validated['status'],
                    'cashier_name' => $validated['cashier_name'],
                    'oop_number' => $validated['oop_number'],
                    'or_date' => $validated['or_date']
                ]);
            }

            $gym->update($validated);

            // Check if status is "Reserved"
            if ($gym->status === 'Reserved') {
                // Update each reservation to check for overlapping reservations
                foreach ($gymReservations as $gymReservation) {
                    // Find overlapping reservations
                    $overlappingReservations = Gym::where('reservation_date', $gymReservation->reservation_date)
                        ->whereIn('status', ['Received', 'Pending'])
                        ->where('reservation_time_start', '<', $gymReservation->reservation_time_end)
                        ->where('reservation_time_end', '>', $gymReservation->reservation_time_start)
                        ->where('id', '!=', $gymReservation->id) // Ensure we don't update the current reservation
                        ->get();

                    // Update the status of overlapping reservations to "Cancelled"
                    foreach ($overlappingReservations as $reservation) {
                        $reservation->update(['status' => 'Cancelled']);
                    }
                }
                // Redirect with success message
                return redirect()->route('cashierpaid')->with('success', 'Payment confirmed successfully!');
            } else {
                // Redirect back with appropriate success message
                return redirect()->route('cashierforpayment')->with('success', 'Payment updated successfully, status is not Paid.');
            }
        } else {
            // Handle case where there is only one or zero reservations (if needed)
            $gym->update($validated);

            // Check if status is "Reserved"
            if ($gym->status === 'Reserved') {
                // Find overlapping reservations
                $overlappingReservations = Gym::where('reservation_date', $gym->reservation_date)
                    ->whereIn('status', ['Received', 'Pending'])
                    ->where('reservation_time_start', '<', $gym->reservation_time_end)
                    ->where('reservation_time_end', '>', $gym->reservation_time_start)
                    ->where('id', '!=', $gym->id) // Ensure we don't update the current reservation
                    ->get();

                // Update the status of overlapping reservations to "Cancelled"
                foreach ($overlappingReservations as $reservation) {
                    $reservation->update(['status' => 'Cancelled']);
                }
                // Redirect with success message
                return redirect()->route('cashierpaid')->with('success', 'Payment confirmed successfully!');
            } else {
                // Redirect back with appropriate success message
                return redirect()->route('cashierforpayment')->with('success', 'Payment updated successfully, status is not Paid.');
            }
        }
    }



    public function editCashierGym(Gym $gym)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $gym->employee_id)
            ->first();
        $receivingUser = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', Auth::id())
            ->first();
        // You can return the modal content as a view
        return view('cashier.cashier-confirmpayment-gym', compact('gym', 'userDetails', 'receivingUser'));
    }

    public function editCashierDorm(Dorm $dorm)
    {
        $receivingUser = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', Auth::id())
            ->first();
        // Calculate the number of days between reservation_start_date and reservation_end_date
        $numberOfDays = DB::table('dorm_reservations')
            ->where('id', $dorm->id) // Assuming 'id' is the primary key of 'dorm_reservations'
            ->select(DB::raw('DATEDIFF(reservation_end_date, reservation_start_date) + 1 as num_days'))
            ->first();

        $orNumber = Str::afterLast($dorm->or_number, '-');

        // Handle if $numberOfDays is null (handle case where $dorm is not found or dates are not set)
        $numDays = $numberOfDays ? $numberOfDays->num_days : 0;
        // You can return the modal content as a view
        return view('cashier.cashier-confirmpayment-dorm', compact('dorm', 'numDays', 'orNumber', 'receivingUser'));
    }

    public function confirmPaymentDorm(Dorm $dorm)
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
                'amount_paid' => 'required|min:3|max:12',
                'status' => 'required',
                'or_date' => 'required|date',
                'cashier_name' => 'required',
            ]);
            // $validated['or_number'] = $currentYearMonth . '-' . $validated['or_number'];
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
            return redirect()->route('cashierpaid')->with('success', 'Payment confirmed successfully!');
        } else {
            return redirect()->route('cashierforpayment')->with('success', 'Payment updated successfully, status is not Paid.');
        }
    }

    public function viewDormPDFCashier(Dorm $dorm)
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

    public function viewGymPDFCashier(Gym $gym)
    {
        // Get all Gym reservations with the same form_group_number
        $gymReservations = Gym::where('form_group_number', $gym->form_group_number)->get();

        // Initialize boolean variables
        $isBasketball = false;
        $isVolleyball = false;
        $isBadminton = false;
        $numberOfCourtsSeparate = 0;

        foreach ($gymReservations as $reservation) {
            if ($reservation->purpose === "Basketball") {
                $isBasketball = true;
            } elseif ($reservation->purpose === "Volleyball") {
                $isVolleyball = true;
            } elseif ($reservation->purpose === "Badminton") {
                $isBadminton = true;
                // $numberOfCourtsSeparate = $reservation->number_of_courts;
            }
        }

        $data = [
            'gym' => $gym,
            'gymReservations' => $gymReservations,
            'isBasketball' => $isBasketball,
            'isVolleyball' => $isVolleyball,
            'isBadminton' => $isBadminton,
            // 'numberOfCourtsSeparate' => $numberOfCourtsSeparate,
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
        $filename = $gym->reservation_number . '_' . $gym->updated_at->format('Y-m-d') . '_gym-reservation.pdf';

        $pdf = PDF::loadView('pdf.GymReservationSheet', $data)->setOptions($options);

        return $pdf->stream($filename);
    }

    public function profile()
    {
        return view('cashier.cashierprofile');
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


        return redirect()->route('cashierprofile')->with('success', 'Password updated successfully.');
    }

    public function viewGymOrderofPaymentPDF(Gym $gym)
    {
        // Get all Gym reservations with the same form_group_number
        $gymReservations = Gym::where('form_group_number', $gym->form_group_number)->get();


        $formattedReservations = $gymReservations->map(function ($reservation) {
            return date('F j, Y', strtotime($reservation->reservation_date)) .
                ' (' . date('g:i A', strtotime($reservation->reservation_time_start)) .
                ' - ' . date('g:i A', strtotime($reservation->reservation_time_end)) . ')';
        });

        $distinctPurposes = Gym::where('form_group_number', $gym->form_group_number)
            ->distinct()
            ->pluck('purpose')
            ->implode(', ');

        // Sum up all total_price values
        $totalPriceSum = Gym::where('form_group_number', $gym->form_group_number)
            ->sum('total_price');

        $numberFormatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $totalPriceSumToWords = $numberFormatter->format($totalPriceSum);


        $reservationsString = $formattedReservations->implode(', ');

        $data = [
            'gym' => $gym,
            'reservationsString' => $reservationsString,
            'distinctPurposes' => $distinctPurposes,
            'totalPriceSum' => $totalPriceSum,
            'totalPriceSumToWords' => $totalPriceSumToWords,
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
        $filename = $gym->oop_number . '_' . $gym->updated_at->format('Y-m-d') . '_orderofpayment.pdf';

        $pdf = PDF::loadView('pdf.OrderofPaymentGym', $data)->setOptions($options);

        // return view('pdf.OrderofPaymentGym', $data);

        return $pdf->stream($filename);
    }
}
