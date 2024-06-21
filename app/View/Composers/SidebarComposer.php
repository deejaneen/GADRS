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
        $dormsPendingCountView = Dorm::where('status', 'Pending')->count();
        // $totalPendingCount = $gymsPendingCount + $dormsPendingCount;

        $gymsReceivedCountView = Gym::where('status', 'Received')->count();
        $dormsReceivedCountView = Dorm::where('status', 'Received')->count();
        // $totalReceivedCount = $gymsReceivedCount + $dormsReceivedCount;

        $view->with('gymsPendingCountView', $gymsPendingCountView)
            ->with('dormsPendingCountView', $dormsPendingCountView)
            ->with('dormsReceivedCountView', $dormsReceivedCountView)
            ->with('gymsReceivedCountView', $gymsReceivedCountView);
    }
}
