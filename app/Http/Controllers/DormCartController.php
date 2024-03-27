<?php

namespace App\Http\Controllers;

use App\Models\DormCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DormCartController extends Controller
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'reservation_start_date' => 'required|date',
            'reservation_start_time' => 'required',
            'reservation_end_date' => 'required|date',
            'reservation_end_time' => 'required',
            'gender' => 'required',
            'quantity' => 'required|integer|min:1',
            'occupant_type' => 'required',
        ]);

        $dormCart = new DormCart();
        $dormCart->reservation_start_date =  $validatedData['reservation_start_date'];
        $dormCart->reservation_start_time =  $validatedData['reservation_start_time'];
        $dormCart->reservation_end_date =  $validatedData['reservation_end_date'];
        $dormCart->reservation_end_time =  $validatedData['reservation_end_time'];
        $dormCart->gender =  $validatedData['gender'];
        $dormCart->quantity =  $validatedData['quantity'];

        //Switch statement here
        $dormCart->occupant_type =  $validatedData['occupant_type'];
        $dormCart->employee_id = Auth::id(); // Use Auth::id() instead of Auth()->id()
        $dormCart->save();

        return redirect()->route('dorm')->with('success', 'Reservation added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DormCart $dormCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DormCart $dormCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DormCart $dormCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DormCart $dormCart)
    {
        //
    }
}
