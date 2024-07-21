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

        // Query to check for overlaps
        $overlappingReservations = Gym::where('id', '!=', $id) // Exclude the current reservation being updated
            ->whereDate('reservation_date', $newReservationDate)
            ->where(function ($query) use ($newStartTime, $newEndTime) {
                $query->whereBetween('reservation_time_start', [$newStartTime, $newEndTime])
                    ->orWhereBetween('reservation_time_end', [$newStartTime, $newEndTime])
                    ->orWhere(function ($query) use ($newStartTime, $newEndTime) {
                        $query->where('reservation_time_start', '<=', $newStartTime)
                            ->where('reservation_time_end', '>=', $newEndTime);
                    });
            })
            ->exists();

        if ($overlappingReservations) {
            return redirect()->back()->with('error', 'The reservation overlaps with an existing reservation.');
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
