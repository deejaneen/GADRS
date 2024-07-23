<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\DateRestriction;
use App\Models\Dorm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the current date
        $today = date('Y-m-d');

        // Fetch beds for male and female dorms for the current date
        $beds_male = Bed::where('gender', 'male')
            ->whereDate('date', $today)
            ->first(); // Get the first bed available for males for the current date

        $beds_female = Bed::where('gender', 'female')
            ->whereDate('date', $today)
            ->first(); // Get the first bed available for females for the current date

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


    public function updateDormReservation(Request $request, $id)
    {
        $reservation = Dorm::findOrFail($id);
        // Calculate the total reservation days
        $startDate = new \DateTime($request['reservation_start_date']);
        $endDate = new \DateTime($request['reservation_end_date']);
        $endDate->modify('+1 day'); // Include the end date in the range
        $interval = \DateInterval::createFromDateString('1 day');
        $dateRange = new \DatePeriod($startDate, $interval, $endDate);

        // Check availability for each date in the reservation period
        foreach ($dateRange as $date) {
            $bed = DB::table('beds')
                ->where('date', $date->format('Y-m-d'))
                ->where('gender', $request['gender'])
                ->first();

            if ($bed && $bed->availability < $reservation['quantity']) {
                Session::flash('error', 'Insufficient bed availability on ' . $date->format('Y-m-d'));
                return redirect()->back()->withInput();
            }
        }
        $reservation->update($request->all());
        $card = "dorm";

        return redirect()->route('home')->with('success', 'Reservation updated successfully!')->with('card', $card);
    }
    public function editDormReservation($id)
    {
        $reservation = Dorm::findOrFail($id);
        return view('editdormreservation', ['reservation' => $reservation]);
    }
    public function destroyDormReservation($id)
    {
        $dorm = Dorm::where('id', $id)->first();
        $dorm->delete();
        $card = "dorm";

        return redirect()->back()->with('success', 'Entry deleted successfully!')->with('card', $card);
    }
}
