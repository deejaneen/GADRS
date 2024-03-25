<?php

namespace App\Http\Controllers;

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
        $userId = Auth::id(); // Get the ID of the authenticated user
        $gymcarts = GymCart::where('employee_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('gym', ['gymcarts' => $gymcarts]);
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
        // Validate the request data
        $validated = $request->validate([
            'reservation_date' => 'required|min:3|max:40',
            'reservation_time_start' => 'required|min:3|max:40',
            'reservation_time_end' => 'required|min:3|max:40',
            'occupant_type' => 'required|email|unique:users,email',
        ]);

        // Create the gym reservation
        // $gym_reservation = Gym::create([
        //     'reservation_date' => $validated['reservation_date'],
        //     'reservation_time_start' => $validated['reservation_time_start'],
        //     'reservation_time_end' => $validated['reservation_time_end'],
        //     'occupant_type' => $validated['occupant_type']
        // ]);

        // Redirect to the home route with a success message
        return redirect()->route('home')->with('success', 'Reservation created successfully!');
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
}
