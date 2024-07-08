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
class ReceivingController extends Controller
{

    public function index()
    {
        $today = now()->startOfDay();
        $gymsPendingCount = Gym::where('status', 'Pending')
            ->where('reservation_date', '>=', $today)
            ->count();
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
            'gymsPendingCount' => $gymsPendingCount,
            'lastMonth' => $lastMonth,
            'currentMonth' => $currentMonth,
            'totalReservationCount' => $totalReservationCount,
            'thisMonthTotalReservationReceived' => $thisMonthTotalReservationReceived,
            'lastMonthTotalReservationReceived' => $lastMonthTotalReservationReceived
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
        if (!$gym->or_number && !$gym->reservation_number) {
            // Validate input when conditions are met
            $validated = request()->validate([
                'reservation_number' => 'required|min:3|max:11|unique:gym-reservations,reservation_number,' . $gym->id,
                'status' => 'required',
                'or_number' => 'required|min:3|max:7|unique:gym-reservations,or_number,' . $gym->id,
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
                'or_number' => [
                    'required',
                    'min:3',
                    'max:7',
                    function ($attribute, $value, $fail) use ($reservationsNotSimilarToOriginal) {
                        foreach ($reservationsNotSimilarToOriginal as $reservation) {
                            if ($reservation->or_number === $value) {
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
                'or_number' => $validated['or_number'],
                'or_date' => $validated['or_date'],
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
        // You can return the modal content as a view
        return view('ras.receiving.receiving-addnumber', compact('gym', 'userDetails'));
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
                $numberOfCourtsSeparate = $reservation->number_of_courts;
            }
        }

        $data = [
            'gym' => $gym,
            'gymReservations' => $gymReservations,
            'isBasketball' => $isBasketball,
            'isVolleyball' => $isVolleyball,
            'isBadminton' => $isBadminton,
            'numberOfCourtsSeparate' => $numberOfCourtsSeparate,
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
}
