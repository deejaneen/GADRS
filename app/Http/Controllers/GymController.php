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

    public function updateGymReservation ()
    {

    }
    public function editGymReservation ()
    {
        
    }
        public function destroyGymReservation ($id)
        {
            $gym = Gym::where('id', $id)->first();
            $gym->delete();

            return redirect()->back()->with('success', 'Entry deleted successfully!');
        }
}
