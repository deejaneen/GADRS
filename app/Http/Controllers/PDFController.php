<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatedormPDF()
    {

        $data = [
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

        $pdf = PDF::loadView('pdf.DormReservationFormSheet1', $data)->setOptions($options);

        return $pdf->download('dorm-reservation.pdf');
    }
    public function generategymPDF()
    {

        $data = [
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

        $pdf = PDF::loadView('pdf.GymReservationSheet', $data)->setOptions($options);

        return $pdf->download('gym-reservation.pdf');
    }
   
}