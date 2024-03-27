<?php

namespace App\Http\Controllers;

use App\Models\DormCart;
use App\Models\GymCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

        $dormcarts = DormCart::where('employee_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('cart_checkout', ['gymcarts' => $gymcarts, 'dormcarts'=> $dormcarts]);
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
