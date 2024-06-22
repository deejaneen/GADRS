<?php

namespace App\Http\Controllers;

use App\Models\Dorm;
use App\Models\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showReservationHistoryProfile()
    {
        $user = Auth::id();
        $gyms = Gym::where('employee_id', $user)
            ->whereIn('status', ['Reserved', 'Unavailable'])
            ->orderBy('created_at', 'DESC')
            ->get();
        $dorms = Dorm::where('employee_id', $user)
            ->whereIn('status', ['Reserved', 'Unavailable'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('profile.reservationhistoryprofile', ['gyms' => $gyms, 'dorms' => $dorms]);
    }
}
