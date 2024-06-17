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
            'beds_male' => $beds_male ? $beds_male->availability : 8, // Access availability if bed exists
            'beds_female' => $beds_female ? $beds_female->availability : 11, // Access availability if bed exists
        ]);
    }

    public function checkBedAvailability(Request $request)
    {
        // Retrieve the input date and gender from the request
        $date = $request->input('date');
        $gender = $request->input('gender');
    
        if (!$date || !$gender) {
            return response()->json(['error' => 'Invalid input.'], 400);
        }
    
        // Check the bed availability for the given gender and date
        $bed = Bed::where('gender', $gender)->where('date', $date)->first();
    
        if ($bed) {
            // If bed availability is found for the date, use it
            $availableBeds = $bed->availability;
        } else {
            // Otherwise, use the default values: 8 for men, 11 for women
            $availableBeds = $gender === 'male' ? 8 : 11;
        }
    
        return response()->json([
            'availableBeds' => $availableBeds,
        ]);
    }
}
