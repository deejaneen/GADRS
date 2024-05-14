<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {

        $data = [
        ];

        $pdf = PDF::loadView('pdf.DormReservationFormSheet1', $data);
        return $pdf->download('users-lists.pdf');
    }
}