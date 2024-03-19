<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addToCart(Request $request)
    {
        dd($request);
        // Validate the request data
        $request->validate([
            'selectedDateText' => 'required|date',
            'timepicker-am' => 'required',
            'timepicker-pm' => 'required',
            'reservorDropdownButton' => 'required',
        ]);

        // Convert reservation_details array to JSON
        $reservationDetails = [
            'selected_date' => $request->input('selectedDateText'),
            'start_time' => $request->input('timepicker-am'),
            'end_time' => $request->input('timepicker-pm'),
            'reservor' => $request->input('reservorDropdownButton'),
        ];
        $reservationDetailsJson = json_encode($reservationDetails);

        // Create a new Cart instance
        $cartItem = new Cart();
        // Assign the JSON string to the reservation_details attribute
        $cartItem->reservation_details = $reservationDetailsJson;

        // Save the cart item
        $cartItem->save();

        // Optionally, you can return a response
        return response()->json(['message' => 'Item added to cart successfully'], 200);
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
