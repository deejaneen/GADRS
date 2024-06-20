<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Dorm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CashierController extends Controller
{
    public function index()
    {
        $gymsCount = Gym::where('status', 'For Payment')->count();
        $dormsCount = Dorm::where('status', 'For Payment')->count();
        $gymsCountPaid = Gym::where('status', 'Paid')->count();
        $dormsCountPaid = Dorm::where('status', 'Paid')->count();
        $gymsCountTotal = Gym::all()->count();
        $dormsCountTotal = Dorm::all()->count();

        return view('cashier.cashierdashboard', ['gymsCount' => $gymsCount, 'dormsCount' => $dormsCount, 'gymsCountPaid' => $gymsCountPaid, 'dormsCountPaid' => $dormsCountPaid, 'gymsCountTotal' => $gymsCountTotal, 'dormsCountTotal' => $dormsCountTotal]);
    }
    public function forpayment()
    {

        $gyms = Gym::where('status', 'Received')->get();
        $dorms = Dorm::where('status', 'Received')->get();

        return view('cashier.cashierforpayment', ['dorms' => $dorms, 'gyms' => $gyms]);
    }

    public function paid()
    {
        $gyms = Gym::where('status', 'Reserved')->get();
        $dorms = Dorm::where('status', 'Reserved')->get();

        return view('cashier.cashierpaid', ['dorms' => $dorms, 'gyms' => $gyms]);
    }

    public function confirmPaymentGym(Gym $gym)
    {
        // Validate input
        $validated = request()->validate([
            'price' => 'required|min:3|max:12',
            'status' => 'required',
        ]);

        // Update the user with the validated data
        $gym->update($validated);

        // Check if status is "Reserved"
        if ($gym->status === 'Reserved') {
            // Redirect with success message
            return redirect()->route('cashierpaid')->with('success', 'Payment confirmed successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('cashierforpayment')->with('success', 'Payment updated successfully, status is not Reserved.');
        }
    }


    public function editCashierGym(Gym $gym)
    {
        // You can return the modal content as a view
        return view('cashier.cashier-confirmpayment-gym', compact('gym'));
    }

    public function editCashierDorm(Dorm $dorm)
    {
        // Calculate the number of days between reservation_start_date and reservation_end_date
        $numberOfDays = DB::table('dorm_reservations')
            ->where('id', $dorm->id) // Assuming 'id' is the primary key of 'dorm_reservations'
            ->select(DB::raw('DATEDIFF(reservation_end_date, reservation_start_date) + 1 as num_days'))
            ->first();

        // Handle if $numberOfDays is null (handle case where $dorm is not found or dates are not set)
        $numDays = $numberOfDays ? $numberOfDays->num_days : 0;
        // You can return the modal content as a view
        return view('cashier.cashier-confirmpayment-dorm', compact('dorm', 'numDays'));
    }

    public function confirmPaymentDorm(Dorm $dorm)
    {
        // Validate input
        $validated = request()->validate([
            // 'price' => 'required|min:3|max:40',
            'status' => 'required',
        ]);

        // Update the user with the validated data
        $dorm->update($validated);

        // Check if status is "Reserved"
        if ($dorm->status === 'Reserved') {
            // Redirect with success message
            return redirect()->route('cashierpaid')->with('success', 'Payment confirmed successfully!');
        } else {
            // Redirect back with appropriate success message
            return redirect()->route('cashierforpayment')->with('success', 'Payment updated successfully, status is not Reserved.');
        }
    }

    public function viewDormPDFCashier(Dorm $dorm)
    {
        // Calculate the number of days between reservation_start_date and reservation_end_date
        $numberOfDays = DB::table('dorm_reservations')
            ->where('id', $dorm->id) // Assuming 'id' is the primary key of 'dorm_reservations'
            ->select(DB::raw('DATEDIFF(reservation_end_date, reservation_start_date) + 1 as num_days'))
            ->first();

        // Handle if $numberOfDays is null (handle case where $dorm is not found or dates are not set)
        $numDays = $numberOfDays ? $numberOfDays->num_days : 0;

        $data = [
            'dorm' => $dorm,
            'numberOfDays' => $numDays,
        ];
        $marginInMillimeters = 0.5 * 25.4; // Convert inches to millimeters

        // Pass options for paper size and margins
        $options = [
            'format' => [8.5, 13], // Set the paper size in inches
            'margin_top' => $marginInMillimeters,
            'margin_bottom' => $marginInMillimeters,
            'margin_left' => $marginInMillimeters,
            'margin_right' => $marginInMillimeters,
        ];

        // Generate the filename based on the dorm's Form_number and updated_at timestamp
        $filename = $dorm->Form_number . '_' . $dorm->updated_at->format('Y-m-d') . '_dorm-reservation.pdf';

        $pdf = PDF::loadView('pdf.DormReservationFormSheet1', $data)->setOptions($options);

        return $pdf->stream($filename);
    }

    public function viewGymPDFCashier(Gym $gym)
    {
        // Get all Gym reservations with the same form_group_number
        $gymReservations = Gym::where('form_group_number', $gym->form_group_number)->get();
        $data = [
            'gym' => $gym,
            'gymReservations' => $gymReservations,
        ];
        $marginInMillimeters = 0.5 * 25.4; // Convert inches to millimeters

        // Pass options for paper size and margins
        $options = [
            'format' => [8.5, 13], // Set the paper size in inches
            'margin_top' => $marginInMillimeters,
            'margin_bottom' => $marginInMillimeters,
            'margin_left' => $marginInMillimeters,
            'margin_right' => $marginInMillimeters,
        ];
        // Generate the filename based on the dorm's Form_number and updated_at timestamp
        $filename = $gym->reservation_number . '_' . $gym->updated_at->format('Y-m-d') . '_gym-reservation.pdf';

        $pdf = PDF::loadView('pdf.GymReservationSheet', $data)->setOptions($options);

        return $pdf->stream($filename);
    }
}
