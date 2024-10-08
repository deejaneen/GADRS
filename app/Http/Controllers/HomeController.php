<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $today = now()->startOfDay(); // Get the start of today

        $gyms = Gym::where('employee_id', $user)
            ->whereNotIn('status', ['OnCart']) // Exclude items with status "Reserved" and "OnCart"
            ->whereDate('created_at', '>=', $today) // Filter by 'created_at' from today onwards
            ->orderBy('created_at', 'DESC')
            ->get();

        $dorms = Dorm::where('employee_id', $user)
            ->whereNotIn('status', ['OnCart']) // Exclude items with status "Reserved" and "OnCart"
            ->whereDate('created_at', '>=', $today) // Filter by 'created_at' from today onwards
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('home', ['gyms' => $gyms, 'dorms' => $dorms]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
