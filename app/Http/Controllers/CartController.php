<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\DormCart;
use App\Models\Gym;
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
        return view('cart_checkout', ['gymcarts' => $gymcarts, 'dormcarts' => $dormcarts]);
    }

    /**
     * Convert DormCart items to DormReservations and save to the database.
     */
    public function DormCartToDormReservations(Request $request)
    {
        try {
            $cartIds = json_decode($request->input('cart_ids_dorm'));

            if (empty($cartIds)) {
                return response()->json(['message' => 'No items selected'], 400);
            }

            foreach ($cartIds as $cartId) {
                $dormCart = DormCart::findOrFail($cartId);

                $dormReservation = new Dorm();
                $dormReservation->fill($dormCart->toArray());
                $dormReservation->save();
            }

            return response()->json(['message' => 'Dorm reservations added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to convert and save dorm reservations'], 500);
        }
    }

    public function GymCartToGymReservations(Request $request)
    {

        try {
            $cartIds = json_decode($request->input('cart_ids_gym'));

            if (empty($cartIds)) {
                return response()->json(['message' => 'No items selected'], 400);
            }

            foreach ($cartIds as $cartId) {
                $gymCart = GymCart::findOrFail($cartId);

                $gymReservation = new Gym();
                $gymReservation->fill($gymCart->toArray());
                $gymReservation->save();
            }

            return response()->json(['message' => 'Gym reservations added successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to convert and save gym reservations'], 500);
        }
    }
}
