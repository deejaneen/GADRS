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
            'beds_male' => $beds_male ? $beds_male->availability : 0, // Access availability if bed exists
            'beds_female' => $beds_female ? $beds_female->availability : 0, // Access availability if bed exists
        ]);
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
    public function show(Dorm $dorm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dorm $dorm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dorm $dorm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dorm $dorm)
    {
        //
    }
}
