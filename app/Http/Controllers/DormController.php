<?php

namespace App\Http\Controllers;

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
        $dorms = Dorm::orderBy('created_at', 'DESC');
        // Modify how you fetch the data, ensuring you only retrieve the date strings
        $dormDateRestrictions = DateRestriction::where('type', 'Dorm')->pluck('restricted_date')->toArray();
        return view('dorm', ['dorms' => $dorms, 'dormDateRestrictions' => $dormDateRestrictions]);
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
