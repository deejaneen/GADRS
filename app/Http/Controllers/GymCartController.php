<?php

namespace App\Http\Controllers;

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
        //
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
        ]);

        // Create a new GymCart instance
        $gymCart = new GymCart();
        $gymCart->reservation_date = $validatedData['selectedDateText'];
        $gymCart->reservation_time_start = $validatedData['timepicker-am'];
        $gymCart->reservation_time_end = $validatedData['timepicker-pm'];
        $gymCart->occupant_type = $validatedData['employee_type'];
        $gymCart->employee_id = Auth::id(); // Use Auth::id() instead of Auth()->id()

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
