<?php

namespace App\Http\Controllers;

use App\Models\DormCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
        // Convert checkbox values to boolean
        $is_senior_or_pwd = $request->has('is_senior_or_pwd');
        $is_child = $request->has('is_child');

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

        // Create a new DormCart instance
        $dormCart = new DormCart();

        // Assign validated data to DormCart properties
        $dormCart->reservation_start_date = $validatedData['reservation_start_date'];
        $dormCart->reservation_start_time = $validatedData['reservation_start_time'];
        $dormCart->reservation_end_date = $validatedData['reservation_end_date'];
        $dormCart->reservation_end_time = $validatedData['reservation_end_time'];
        $dormCart->gender = $validatedData['gender'];
        $dormCart->quantity = $validatedData['quantity'];
        $dormCart->is_senior_or_pwd = $is_senior_or_pwd; // Assign the boolean value
        $dormCart->is_child = $is_child; // Assign the boolean value

        // Calculate the price based on occupant_type
        switch ($validatedData['occupant_type']) {
            case 'COA':
                $dormCart->price = $is_senior_or_pwd ? 200 * 0.8 : 200; // 20% discount if senior/PWD
                break;
            case 'Non COAn':
                $dormCart->price = $is_senior_or_pwd ? 400 * 0.8 : 400; // 20% discount if senior/PWD
                break;
            default:
                // Default price in case occupant_type doesn't match any case
                $dormCart->price = 0;
                break;
        }

        // Assign other properties
        $dormCart->occupant_type = $validatedData['occupant_type'];
        $dormCart->employee_id = Auth::id(); // Use Auth::id() instead of Auth()->id()

        // Save the DormCart instance
        $dormCart->save();

        // Redirect with success message
        // return redirect()->back()->with('success', 'Reservation added to cart successfully!');
        // Flash success message to session
        Session::flash('success', 'Reservation added to cart successfully!');

        // Redirect the user back to the page with an anchor pointing to the specific card's ID
        return redirect()->route('dorm')->with([
            'current_card' => $request->current_card,
            'success' => 'Reservation added to cart successfully!'
        ]);


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
