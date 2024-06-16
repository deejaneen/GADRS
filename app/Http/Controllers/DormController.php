<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\DateRestriction;
use App\Models\Dorm;
use Illuminate\Http\Request;


class DormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch beds for male and female dorms
        $beds_male = Bed::where('gender', 'male')->first(); // Get the first bed available for males
        $beds_female = Bed::where('gender', 'female')->first(); // Get the first bed available for females

        // Fetch dorms ordered by creation date
        $dorms = Dorm::orderBy('created_at', 'DESC')->get();

        // Fetch only the date strings for dorm date restrictions
        $dormDateRestrictions = DateRestriction::where('type', 'Dorm')->pluck('restricted_date')->toArray();

        // Pass data to the view
        return view('dorm', [
            'dorms' => $dorms,
            'dormDateRestrictions' => $dormDateRestrictions,
            'beds_male' => $beds_male ? $beds_male->availability : 0, // Access availability if bed exists
            'beds_female' => $beds_female ? $beds_female->availability : 0, // Access availability if bed exists
        ]);
    }

    public function checkBedAvailability(Request $request)
    {
        // Retrieve the input date from the request
        $date = $request->input('date');
        $gender = $request->input('gender');

        if (!$date || !$gender) {
            return response()->json(['error' => 'Invalid input.'], 400);
        }

        // Fetch reservations that have the status 'Reserved'
        $reservations = Dorm::where('gender', $gender)
            ->where('status', 'Reserved')
            ->get();

        // Initialize total reserved beds to 0
        $totalReservedBeds = 0;

        // Check if the selected date falls within any reservation ranges
        $dateInRange = false;
        foreach ($reservations as $reservation) {
            if ($reservation->reservation_start_date <= $date && $reservation->reservation_end_date >= $date) {
                $totalReservedBeds += $reservation->quantity;
                $dateInRange = true;
            }
        }

        // Get the total availability of beds for the given gender
        $bed = Bed::where('gender', $gender)->first();
        $totalBeds = $bed ? $bed->availability : 0;

        if ($dateInRange) {
            // If the date is within any reservation range, display available beds directly from the database
            $availableBeds = $totalBeds;
        } else {
            // Check if the selected date is before the earliest reservation or after the latest reservation
            $earliestReservation = $reservations->min('reservation_start_date');
            $latestReservation = $reservations->max('reservation_end_date');

            if ($date < $earliestReservation) {
                // If the selected date is before the earliest reservation, display available beds from the database
                $availableBeds = $totalBeds;
            } elseif ($date > $latestReservation) {
                // If the selected date is after the latest reservation, display default values
                $availableBeds = ($gender === 'male') ? 8 : 11;
            } else {
                // If the selected date is between reservations but not within any range, calculate availability
                // foreach ($reservations as $reservation) {
                //     if ($reservation->reservation_end_date < $date) {
                //         $totalReservedBeds += $reservation->quantity;
                //     }
                // }
                $bedCountBasedOnGender = ($gender === 'male') ? 8 : 11;
                $latestReservationInBetween = Dorm::where('gender', $gender)
                    ->where('reservation_start_date', '>=', $date)
                    ->orderBy('reservation_start_date', 'desc')
                    ->first();
                $availableBeds = $bedCountBasedOnGender - $latestReservationInBetween->quantity;
            }
        }

        // Return the results
        return response()->json([
            'availableBeds' => $availableBeds,
        ]);
    }
}
