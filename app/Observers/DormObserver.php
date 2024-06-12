<?php

namespace App\Observers;

use App\Models\Bed;
use App\Models\Dorm;
use Illuminate\Support\Facades\Log;

class DormObserver
{
    /**
     * Handle the Dorm "created" event.
     */
    public function created(Dorm $dorm): void
    {
        //
    }

    /**
     * Handle the Dorm "updated" event.
     */
    public function updated(Dorm $dorm)
    {
        // Log that the updated method is being called
        // Log::info('DormObserver: updated method called for Dorm ID ' . $dorm->id);

        // Log the current status of the dorm
        // Log::info('DormObserver: Current status of Dorm ID ' . $dorm->id . ' is ' . $dorm->status);

        if ($dorm->status === 'Received') {
            // Find the bed based on gender
            $bed = Bed::where('gender', $dorm->gender)->first();

            if ($bed && $bed->availability >= $dorm->quantity) {
                // Subtract the quantity from the availability
                $bed->availability -= $dorm->quantity;
                $bed->save();
            } else {
                if (!$bed) {
                    // Log an error if the bed is not found
                    Log::error('No bed found for gender: ' . $dorm->gender);
                } else {
                    // Log an error or take appropriate action for insufficient availability
                    Log::error('Not enough beds available for reservation: ' . $dorm->id);
                    // Optionally, you can revert the reservation status or throw an exception
                }
            }
        }
    }

    /**
     * Handle the Dorm "deleted" event.
     */
    public function deleted(Dorm $dorm): void
    {
        //
    }

    /**
     * Handle the Dorm "restored" event.
     */
    public function restored(Dorm $dorm): void
    {
        //
    }

    /**
     * Handle the Dorm "force deleted" event.
     */
    public function forceDeleted(Dorm $dorm): void
    {
        //
    }
}
