<?php

namespace App\Http\Controllers;

use App\Models\DateRestriction;
use App\Models\Gym;
use App\Models\GymCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gymcarts = GymCart::orderBy('created_at', 'DESC');
        // Modify how you fetch the data, ensuring you only retrieve the date strings
        $gymDateRestrictions = DateRestriction::where('type', 'Gym')->pluck('restricted_date')->toArray();

        return view('gym', ['gymcarts' => $gymcarts, 'gymDateRestrictions' => $gymDateRestrictions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gym $gym)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        //
    }

    public function getReservations(Request $request)
    {
        // Get the selected date from the request
        $selectedDate = $request->input('selected_date');

        // Fetch reservations with status "Reserved" for the selected date
        $reservations = Gym::whereDate('reservation_date', $selectedDate)
            ->where('status', 'Reserved')
            ->get();

        // Return the reservations as JSON response
        return response()->json($reservations);
    }

    public function updateGymReservation(Request $request, $id)
    {
        $reservation = Gym::findOrFail($id);

        // Extract input values from the request
        $newReservationDate = $request->input('reservation_date');
        $newStartTime = $request->input('reservation_time_start');
        $newEndTime = $request->input('reservation_time_end');

        // Check if the selected day and time fall within the allowed ranges
        $dayOfWeek = date('N', strtotime($newReservationDate));
        $startTime = strtotime($newStartTime);
        $endTime = strtotime($newEndTime);

        // Define allowed time ranges based on the day of the week
        $allowedRanges = [
            1 => [ // Monday
                ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            2 => [ // Tuesday
                ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            3 => [ // Wednesday
                ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            4 => [ // Thursday
                ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            5 => [ // Friday
                ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            6 => [ // Saturday
                ['06:00', '21:00'],
            ],
            7 => [ // Sunday
                ['06:00', '21:00'],
            ],
        ];

        // Check if the selected time falls within any of the allowed ranges
        $isValidRange = false;
        foreach ($allowedRanges[$dayOfWeek] as $range) {
            $rangeStart = strtotime($range[0]);
            $rangeEnd = strtotime($range[1]);
            if ($startTime >= $rangeStart && $endTime <= $rangeEnd) {
                $isValidRange = true;
                break;
            }
        }

        if (!$isValidRange) {
            return redirect()->back()->with('error', 'The selected time slot is not allowed for the selected day.');
        }

         
        // Check for overlapping reservations
        $overlappingReservation = Gym::where('status', 'Reserved')
            ->where('reservation_date',  $newReservationDate)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereBetween('reservation_time_start', [$request->input('reservation_time_start'),  $request->input('reservation_time_end')])
                        ->orWhereBetween('reservation_time_end', [$request->input('reservation_time_start'),  $request->input('reservation_time_end')]);
                })
                    ->orWhere(function ($q) use ($request) {
                        $q->where('reservation_time_start', '<=', $request->input('reservation_time_start'))
                            ->where('reservation_time_end', '>=', $request->input('reservation_time_end'));
                    });
            })
            ->exists();

    
        if ($overlappingReservation) {
            // Check if the start time is exactly the end time of an existing reservation
            // Check if the start time is exactly the end time of an existing reservation
            $overlappingEndTimeReservation = Gym::where('status', 'Reserved')
                ->where('reservation_date',  $newReservationDate)
                ->where('reservation_time_end', $newStartTime)
                ->first();

            if ($overlappingEndTimeReservation) {
                $endTime = date('g:i A', strtotime($overlappingEndTimeReservation->reservation_time_end));
                $message = 'The selected start time overlaps with the end time of an existing reservation ending at ' . $endTime . '. Please choose/adjust another start time.';
                return redirect()>back()->with('error', $message);
            }


            return redirect()->back()->with('error', 'The selected time slot overlaps with an existing reservation. Please choose another time slot.');
        }

        // Update the reservation if there are no overlaps
        $reservation->update($request->all());

        return redirect()->route('home')->with('success', 'Reservation updated successfully!');
    }

    public function editGymReservation($id)
    {
        $reservation = Gym::findOrFail($id);
        return view('editgymreservation', ['reservation' => $reservation]);
    }
    public function destroyGymReservation($id)
    {
        $gym = Gym::where('id', $id)->first();
        $gym->delete();

        return redirect()->back()->with('success', 'Entry deleted successfully!');
    }
}
