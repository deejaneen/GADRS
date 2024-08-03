<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Gym;
use App\Models\Dorm;

class SidebarComposer
{
    public function compose(View $view)
    {
        $today = now()->startOfDay();
        $gymsPendingCountView = Gym::where('status', 'Pending')
            ->where('reservation_date', '>=', $today)
            ->count();
        $gymsReceivedCountView = Gym::where('status', 'Received')
            ->where('reservation_date', '>=', $today)
            ->count();
        $gymsReservedCountView = Gym::where('status', 'Reserved')
            ->where('reservation_date', '>=', $today)
            ->count();

        $dormsPendingCountView = Dorm::where('status', 'Pending')
            ->where('reservation_end_date', '>=', $today)
            ->count();

        $dormsReceivedCountView = Dorm::where('status', 'Received')
            ->where('reservation_end_date', '>=', $today)
            ->count();

        $dormsReservedCountView = Dorm::where('status', 'Reserved')
            ->where('reservation_end_date', '>=', $today)
            ->count();

        // $dormsPendingCountView = Dorm::where('status', 'Pending')->count();
        // $totalPendingCount = $gymsPendingCount + $dormsPendingCount;

        // $gymsReceivedCountView = Gym::where('status', 'Received')->count();
        // $dormsReceivedCountView = Dorm::where('status', 'Received')->count();

        // $totalReceivedCount = $gymsReceivedCount + $dormsReceivedCount;
        // $gymsReservedCountView = Gym::where('status', 'Reserved')->count();
        // $dormsReservedCountView = Dorm::where('status', 'Reserved')->count();

        $view->with('gymsPendingCountView', $gymsPendingCountView)
            ->with('dormsPendingCountView', $dormsPendingCountView)
            ->with('gymsReservedCountView', $gymsReservedCountView)
            ->with('dormsReservedCountView', $dormsReservedCountView)
            ->with('dormsReceivedCountView', $dormsReceivedCountView)
            ->with('gymsReceivedCountView', $gymsReceivedCountView);
    }
}
