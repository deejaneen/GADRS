<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use NumberFormatter;


class ReceivingController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();
        $startOfMonth = $today->copy()->startOfMonth();

        // Calculate Daily Total Reservations
        $dailyTotalReservations = Gym::whereDate('created_at', $today)->count();

        // Calculate Weekly Total Reservations
        $weeklyTotalReservations = Gym::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Calculate Monthly Total Reservations
        $monthlyTotalReservations = Gym::whereBetween('created_at', [$startOfMonth, $today])->count();

        // Get current month's total reservation received
        $currentMonth = $today->format('F'); // Format the current month to display in words
        $currentYear = $today->year;
        $thisMonthGymReceivedCount = Gym::whereMonth('created_at', $today->month)->whereYear('created_at', $currentYear)->count();

        // Get last month's total reservation received
        $lastMonth = $today->copy()->subMonth()->format('F'); // Format the last month to display in words
        $lastMonthYear = $today->copy()->subMonth()->year;
        $lastMonthGymReceivedCount = Gym::whereMonth('created_at', $today->copy()->subMonth()->month)->whereYear('created_at', $lastMonthYear)->count();

        return view('ras.receiving.receivingdashboard', [
            'today' => $today,
            'dailyTotalReservations' => $dailyTotalReservations,
            'weeklyTotalReservations' => $weeklyTotalReservations,
            'monthlyTotalReservations' => $monthlyTotalReservations,
            'lastMonth' => $lastMonth,
            'currentMonth' => $currentMonth,
            'thisMonthGymReceivedCount' => $thisMonthGymReceivedCount,
            'lastMonthGymReceivedCount' => $lastMonthGymReceivedCount,
            'weekStart' => $startOfWeek->format('F j, Y'),
            'weekEnd' => $endOfWeek->format('F j, Y')
        ]);
    }

    public function receivingpending()
    {
        $today = now()->startOfDay();
        $gymsPendingCount  = Gym::where('status', 'Pending')
            ->where('reservation_date', '>=', $today)
            ->count();
        $gyms = Gym::where('status', 'Pending')
            ->where('reservation_date', '>=', $today)
            ->get();

        return view('ras.receiving.receivingpending', [
            'gymsPendingCount' => $gymsPendingCount,
            'gyms' => $gyms
        ]);
    }
    public function receivingpaid()
    {
        $today = now()->startOfDay();
        $gymsPaidCount  = Gym::where('status', 'Paid')
            ->where('reservation_date', '>=', $today)
            ->count();
        $gyms = Gym::where('status', 'Paid')
            ->where('reservation_date', '>=', $today)
            ->get();

        return view('ras.receiving.receivingpaid', [
            'gymsPaidCount' => $gymsPaidCount,
            'gyms' => $gyms
        ]);
    }
    public function receivingreceived()
    {
        $gymsPendingCount = Gym::where('status', 'Received')->count();
        $dormsPendingCount = Dorm::where('status', 'Received')->count();

        $gyms = Gym::where('status', 'Received')->orderBy('created_at', 'DESC')->get();
        $dorms = Dorm::where('status', 'Received')->orderBy('created_at', 'DESC')->get();

        $totalReservationCount = $gymsPendingCount + $dormsPendingCount;
        return view('ras.receiving.receivingreceived', [
            'gymsPendingCount' => $gymsPendingCount,
            'dormsPendingCount' => $dormsPendingCount,
            'totalReservationCount' => $totalReservationCount,
            'gyms' =>  $gyms,
            'dorms' => $dorms,
        ]);
    }
    public function receivingedit()
    {
        return view('ras.receiving.receivingedit');
    }

    public function addFormNumber(Gym $gym)
    {
        if (!$gym->reservation_number && !$gym->oop_number) {
            // Validate input when conditions are met
            $validated = request()->validate([
                'reservation_number' => 'required|min:3|max:11|unique:gym-reservations,reservation_number,' . $gym->id,
                'status' => 'required',
                'receiver_name' => 'required',
                // 'or_number' => 'required|min:3|max:7|unique:gym-reservations,or_number,' . $gym->id,
                'oop_number' => 'required|min:3|max:11|unique:gym-reservations,oop_number,' . $gym->id,
                'or_date' => 'required|date',
                // 'reservation_date' => 'required|date',
            ]);
        } else {
            // Validate input when conditions are not met
            $reservationsNotSimilarToOriginal = Gym::where('form_group_number', '!=', $gym->form_group_number)
                ->get();

            $validated = request()->validate([
                'reservation_number' => [
                    'required',
                    'min:3',
                    'max:11',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->reservation_number === $value) {
                                $fail('The ' . $attribute . ' has already been taken.');
                            }
                        }
                    },
                ],
                'status' => 'required',
                'receiver_name' => 'required',
                // 'or_number' => [
                //     'required',
                //     'min:3',
                //     'max:7',
                //     function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                //         foreach ($reservationsNotSimilarToOriginal as $reservation) {
                //             if ($reservation->or_number === $value) {
                //                 $fail('The ' . $attribute . ' has already been taken.');
                //             }
                //         }
                //     },
                // ],
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
                // 'reservation_date' => 'required|date',
            ]);
        }

        // Update the gym with the validated data
        $gym->update($validated);

        // Get all pending Gym reservations with the same form group number
        $pendingGyms = Gym::where('status', 'Pending')
            ->where('form_group_number', $gym->form_group_number)
            ->get();

        // Update each pending Gym reservation with the new reservation number, status, or_number, and or_date
        foreach ($pendingGyms as $pendingGym) {
            $pendingGym->update([
                'reservation_number' => $validated['reservation_number'],
                'status' => $validated['status'],
                // 'or_number' => $validated['or_number'],
                'or_date' => $validated['or_date'],
                'oop_number' => $validated['oop_number'],
                'receiver_name' => $validated['receiver_name'],
                // 'reservation_date' => $validated['reservation_date'],
            ]);
        }

        // Check if status is "Received"
        if ($gym->status === 'Received') {
            // Redirect with success message
            return redirect()->route('receivingreceived')->with('success', 'Items updated successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('receivingpending')->with('success', 'Items updated successfully, status is not Received.');
        }

        // Redirect back with success message
        // return redirect()->route('receivingpending')->with('success', 'Form Number added successfully!');
    }


    public function editGym(Gym $gym)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $gym->employee_id)
            ->first();
        $receivingUser = User::select('first_name', 'middle_name', 'last_name')
        ->where('id', Auth::id())
        ->first();
        $reservationNumber = Str::afterLast($gym->reservation_number, '-');
        $oopNumber = Str::afterLast($gym->oop_number, '-');
        // You can return the modal content as a view
        return view('ras.receiving.receiving-addnumber', compact('gym', 'userDetails', 'oopNumber', 'reservationNumber', 'receivingUser'));
    }
    public function addORNumber(Gym $gym)
    {
       
        return view('ras.receiving.receiving-add-or-number');
    }

    public function viewGym(Gym $gym)
    {
        $userDetails = User::select('first_name', 'middle_name', 'last_name')
            ->where('id', $gym->employee_id)
            ->first();
        return view('ras.receiving.receiving-view-gym', compact('gym', 'userDetails'));
    }

    public function viewGymPDF(Gym $gym)
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
        return view('ras.receiving.receivingprofile');
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


        return redirect()->route('receivingprofile')->with('success', 'Password updated successfully.');
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

        return $pdf->stream($filename);
    }
}
