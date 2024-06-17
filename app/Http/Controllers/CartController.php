<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\DormCart;
use App\Models\FormNumber;
use App\Models\Gym;
use App\Models\GymCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                Session::flash('error', 'No items selected');
                return redirect()->back();
            }
    
            $formGroupNumber = $this->generateFormGroupNumber(); // Generate a common identifier
    
            foreach ($cartIds as $cartId) {
                $dormCart = DormCart::findOrFail($cartId);
    
                // Calculate the total reservation days
                $startDate = new \DateTime($dormCart->reservation_start_date);
                $endDate = new \DateTime($dormCart->reservation_end_date);
                $endDate->modify('+1 day'); // Include the end date in the range
                $interval = \DateInterval::createFromDateString('1 day');
                $dateRange = new \DatePeriod($startDate, $interval, $endDate);
    
                // Check availability for each date in the reservation period
                foreach ($dateRange as $date) {
                    $availability = DB::table('beds')
                        ->where('date', $date->format('Y-m-d'))
                        ->where('gender', $dormCart->gender)
                        ->sum('availability');
    
                    if ($availability < $dormCart->quantity) {
                        Session::flash('error', 'Insufficient availability on ' . $date->format('Y-m-d'));
                        return redirect()->back();
                    }
                }
    
                // Proceed with creating the reservation
                $dormReservation = new Dorm();
                $dormReservation->fill($dormCart->toArray());
                $dormReservation->form_group_number = $formGroupNumber; // Assign common identifier
                $dormReservation->first_name = $request->input('hidden_firstname');
                $dormReservation->middle_name  = $request->input('hidden_middlename');
                $dormReservation->last_name  = $request->input('hidden_surname');
                $dormReservation->office = $request->input('hidden_office');
                $dormReservation->office_address = $request->input('hidden_office_address');
                $dormReservation->position = $request->input('hidden_position');
                $dormReservation->contact_number  = $request->input('hidden_contact_number_dorm');
                $dormReservation->email  = $request->input('hidden_email');
                $dormReservation->employee_number  = $request->input('hidden_ei_number');
                $dormReservation->id_presented  = $request->input('hidden_id_presented');
                $dormReservation->purpose_of_stay  = $request->input('hidden_pos');
    
                // COA Employee (if applicable)
                $dormReservation->coa_referrer  = $request->input('hidden_coaEm_name');
                $dormReservation->relationship_with_guest = $request->input('hidden_coaEm_relationshipGuest');
                $dormReservation->coa_referrer_office  = $request->input('hidden_coaEm_office');
                $dormReservation->coa_referrer_office_address  = $request->input('hidden_coaEm_office_address');
    
                // Emergency Contact
                $dormReservation->emergency_contact = $request->input('hidden_ptn');
                $dormReservation->emergency_contact_number = $request->input('hidden_ptn_contact');
                $dormReservation->home_address  = $request->input('hidden_ptn_home_address');
    
                // Set status to 'Pending' for non-COA
                if ($dormCart->occupant_type != 'Non COAn') {
                    $dormReservation->status = 'Pending';
                }
    
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

            // if (empty($cartIds)) {
            //     return redirect()->back()->withErrors(['error' => 'No Items Selected']);
            // }

            // dd(count($cartIds));
            // Check if the number of items exceeds five
            if (count($cartIds) > 3) {
                return redirect()->back()->withErrors(['error' => 'The maximum items to be put into a form is limited to five only.']);
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
                    $gymReservation->status = 'Pending';

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

    public function destroyGym(Request $request)
    {
        // Retrieve the dorm cart ID from the request
        $gymCartId = $request->input('gym_cart_id_delete');

        // Find the dorm cart item
        $gymCart = GymCart::find($gymCartId);

        if ($gymCart) {
            // Delete the dorm cart item
            $gymCart->delete();

            return redirect()->back()->with('success', 'Gym item/s removed from cart successfully!');
        } else {
            // Optionally, handle the case where the dorm cart item is not found
            return redirect()->back()->with(['error' => 'Gym cart item not found'], 404);
        }
    }

    public function destroyDorm(Request $request)
    {
        // Retrieve the dorm cart ID from the request
        $dormCartId = $request->input('dorm_cart_id_delete');

        // Find the dorm cart item
        $dormCart = DormCart::find($dormCartId);

        if ($dormCart) {
            // Delete the dorm cart item
            $dormCart->delete();

            return redirect()->back()->with('success', 'Dorm item/s removed from cart successfully!');
        } else {
            // Optionally, handle the case where the dorm cart item is not found
            return redirect()->back()->with(['error' => 'Dorm cart item not found'], 404);
        }
    }
}
