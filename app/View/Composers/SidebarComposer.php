<?php
namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Gym;
use App\Models\Dorm;

class SidebarComposer
{
    public function compose(View $view)
    {
        $gymsPendingCountView = Gym::where('status', 'Pending')->count();
        $dormsPendingCountView = Dorm::where('status', 'Pending')->count();
        // $totalPendingCount = $gymsPendingCount + $dormsPendingCount;

        $gymsReceivedCount = Gym::where('status', 'Received')->count();
        $dormsReceivedCount = Dorm::where('status', 'Received')->count();
        // $totalReceivedCount = $gymsReceivedCount + $dormsReceivedCount;

        $view->with('gymsPendingCountView', $gymsPendingCountView)
             ->with('dormsPendingCountView', $dormsPendingCountView);
    }
}
