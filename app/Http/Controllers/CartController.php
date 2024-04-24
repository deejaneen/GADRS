<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\DormCart;
use App\Models\FormNumber;
use App\Models\Gym;
use App\Models\GymCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id(); // Get the ID of the authenticated user

        // Get today's date
        $today = now()->startOfDay();

        // Get the next upcoming day
        $nextDay = now()->addDay()->startOfDay();

        $gymcarts = GymCart::where('employee_id', $userId)
            ->where('status', 'OnCart')
            ->whereBetween('created_at', [$today, $nextDay])
            ->orderBy('created_at', 'DESC')
            ->get();

        $dormcarts = DormCart::where('employee_id', $userId)
            ->where('status', 'OnCart')
            ->whereBetween('created_at', [$today, $nextDay])
            ->orderBy('created_at', 'DESC')
            ->get();

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
                return redirect()->back()->withErrors(['error' => 'No Items Selected']);
            }

            $formGroupNumber = $this->generateFormGroupNumber(); // Generate a common identifier

            foreach ($cartIds as $cartId) {
                $dormCart = DormCart::findOrFail($cartId);

                // Check if the reservation already exists
                $check = Dorm::where('reservation_start_date', $dormCart->reservation_start_date)
                    ->where('reservation_start_time', $dormCart->reservation_start_time)
                    ->where('reservation_end_date', $dormCart->reservation_end_date)
                    ->where('reservation_end_time', $dormCart->reservation_end_time)
                    ->where('occupant_type', $dormCart->occupant_type)
                    ->exists();

                if ($check) {
                    Session::flash('error', 'The item in your cart is already reserved for the selected date and time.');
                    return redirect()->back();
                }

                // Assign the common identifier to the reservation
                $dormReservation = new Dorm();
                $dormReservation->fill($dormCart->toArray());
                $dormReservation->form_group_number = $formGroupNumber; // Assign common identifier
                $dormReservation->save();
            }

            return redirect()->route('home')->with('success', 'Dorm Reservation added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Dorm Reservation unsuccessful']);
        }
    }

    public function GymCartToGymReservations(Request $request)
    {
        try {
            $cartIds = json_decode($request->input('cart_ids_gym'));

            if (empty($cartIds)) {
                return redirect()->back()->withErrors(['error' => 'No Items Selected']);
            }

            $formGroupNumber = $this->generateFormGroupNumber(); // Generate a common identifier

            foreach ($cartIds as $cartId) {
                $gymCart = GymCart::findOrFail($cartId);

                $check = Gym::where('reservation_date', $gymCart->reservation_date)
                    ->where('reservation_time_start', $gymCart->reservation_time_start)
                    ->where('reservation_time_end', $gymCart->reservation_time_end)
                    ->where('occupant_type', $gymCart->occupant_type)
                    ->where('purpose', $gymCart->purpose)
                    ->exists();

                if ($check) {
                    Session::flash('error', 'The item in your cart is already reserved for the selected date and time.');
                    return redirect()->back();
                } else {
                    $gymReservation = new Gym();
                    $gymReservation->fill($gymCart->toArray());
                    $gymReservation->form_group_number = $formGroupNumber; // Assign common identifier

                   $gymReservation->company_name = $request->input('hidden_companyName');
                   $gymReservation->representative = $request->input('hidden_nameRepresentative');
                   $gymReservation->office_address = $request->input('hidden_address');
                   $gymReservation->contact_number = $request->input('hidden_contactNumber');
                    $gymReservation->save();
                }
            }

            return redirect()->route('home')->with('success', 'Gym Reservation added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gym Reservation unsuccessful']);
        }
    }

    private function generateFormGroupNumber()
    {
        try {
            $formNumber = new FormNumber();
            $formNumber->save();
            return $formNumber->id;
        } catch (\Exception $e) {
            // Handle exception if necessary
            dd($e->getMessage()); // Output exception message for debugging
            return null;
        }
    }
}
