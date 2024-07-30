<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\GymCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GymCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $validatedData = $request->validate([
            'selectedDateText' => 'required|date',
            'timepicker-am' => 'required|date_format:H:i',
            'timepicker-pm' => 'required|date_format:H:i|after:timepicker-am',
            'employee_type' => 'required',
            'purpose' => 'required',
            // 'number_of_courts' => 'required_if:purpose,Badminton|nullable|integer|max:4',
            'total_price' => 'required',
        ]);

        $userId = Auth::id();

        // Check if there is an overlapping gym reservation with the same purpose
        $existingReservation = GymCart::where('reservation_date', $validatedData['selectedDateText'])
            ->where('occupant_type', $validatedData['employee_type'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($subQuery) use ($validatedData) {
                    $subQuery->where('reservation_time_start', '<', $validatedData['timepicker-pm'])
                        ->where('reservation_time_end', '>', $validatedData['timepicker-am']);
                });
            })
            ->where('purpose', $validatedData['purpose'])
            ->where('employee_id', $userId)
            ->exists();

        // Check if there is an overlapping gym reservation without considering the purpose
        $existingReservationWithoutPurpose = GymCart::where('reservation_date', $validatedData['selectedDateText'])
            ->where('occupant_type', $validatedData['employee_type'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($subQuery) use ($validatedData) {
                    $subQuery->where('reservation_time_start', '<', $validatedData['timepicker-pm'])
                        ->where('reservation_time_end', '>', $validatedData['timepicker-am']);
                });
            })
            ->where('employee_id', $userId)
            ->exists();


        if ($existingReservation) {
            return redirect()->route('gym')->with('error', 'A similar reservation already exists or overlaps with your current reservation');
        } else if ($existingReservationWithoutPurpose) {
            return redirect()->route('gym')->with('error', 'A reservation with a similar time range already exists in your reservations');
        }

        // Check if the selected day and time fall within the allowed ranges
        $dayOfWeek = date('N', strtotime($validatedData['selectedDateText']));
        $startTime = strtotime($validatedData['timepicker-am']);
        $endTime = strtotime($validatedData['timepicker-pm']);

        // Define allowed time ranges based on the day of the week
        $allowedRanges = [
            1 => [ // Monday
                // ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            2 => [ // Tuesday
                // ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            3 => [ // Wednesday
                // ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            4 => [ // Thursday
                // ['06:00', '11:00'],
                ['18:00', '21:00'],
            ],
            5 => [ // Friday
                // ['06:00', '11:00'],
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
            return redirect()->route('gym')->with('error', 'The selected time slot is not allowed for the selected day.');
        }

        // Check for overlapping reservations
        $overlappingReservation = Gym::where('status', 'Reserved')
            ->where('reservation_date', $validatedData['selectedDateText'])
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($q) use ($validatedData) {
                    $q->whereBetween('reservation_time_start', [$validatedData['timepicker-am'], $validatedData['timepicker-pm']])
                        ->orWhereBetween('reservation_time_end', [$validatedData['timepicker-am'], $validatedData['timepicker-pm']]);
                })
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('reservation_time_start', '<=', $validatedData['timepicker-am'])
                            ->where('reservation_time_end', '>=', $validatedData['timepicker-pm']);
                    });
            })
            ->exists();

        if ($overlappingReservation) {
            // Check if the start time is exactly the end time of an existing reservation
            // Check if the start time is exactly the end time of an existing reservation
            $overlappingEndTimeReservation = Gym::where('status', 'Reserved')
                ->where('reservation_date', $validatedData['selectedDateText'])
                ->where('reservation_time_end', $validatedData['timepicker-am'])
                ->first();

            if ($overlappingEndTimeReservation) {
                $endTime = date('g:i A', strtotime($overlappingEndTimeReservation->reservation_time_end));
                $message = 'The selected start time overlaps with the end time of an existing reservation ending at ' . $endTime . '. Please choose/adjust another start time.';
                return redirect()->route('gym')->with('error', $message);
            }


            return redirect()->route('gym')->with('error', 'The selected time slot overlaps with an existing reservation. Please choose another time slot.');
        }



        // Create a new GymCart instance
        $gymCart = new GymCart();
        $gymCart->reservation_date = $validatedData['selectedDateText'];
        $gymCart->reservation_time_start = $validatedData['timepicker-am'];
        $gymCart->reservation_time_end = $validatedData['timepicker-pm'];
        $gymCart->occupant_type = $validatedData['employee_type'];
        $gymCart->purpose = $validatedData['purpose'];
        $gymCart->total_price = $validatedData['total_price'];
        $gymCart->employee_id = Auth::id(); // Use Auth::id() instead of Auth()->id()

        // Only set number_of_courts if it exists in validated data
        // if (isset($validatedData['number_of_courts'])) {
        //     $gymCart->number_of_courts = $validatedData['number_of_courts'];
        // }

        // Save the GymCart instance to the database
        $gymCart->save();

        return redirect()->route('gym')->with('success', 'Reservation added to cart successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(GymCart $gymCart)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymCart $gymCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GymCart $gymCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GymCart $gymCart)
    {
        //
    }
}
