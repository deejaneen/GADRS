<?php

namespace App\Observers;

use App\Models\Bed;
use App\Models\Dorm;
use Illuminate\Support\Facades\DB;
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
        if ($dorm->status === 'Reserved' && !$dorm->Form_number) {
            $startDate = $dorm->reservation_start_date;
            $endDate = $dorm->reservation_end_date;
            $quantity = $dorm->quantity;
            $gender = $dorm->gender;

            $currentDate = $startDate;
            $dates = [];

            // Collect all dates in the reservation range
            while ($currentDate <= $endDate) {
                $dates[] = $currentDate;
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

            // Use a transaction to ensure atomicity
            DB::transaction(function () use ($dates, $quantity, $gender, $dorm) {
                foreach ($dates as $date) {
                    $bed = Bed::where('date', $date)->where('gender', $gender)->first();

                    if ($bed) {
                        // If the bed record exists, check availability
                        if ($bed->availability >= $quantity) {
                            $bed->availability -= $quantity;
                            $bed->save();
                        } else {
                            // Log an error or take appropriate action for insufficient availability
                            Log::error('Not enough beds available for reservation: ' . $dorm->id . ' on date: ' . $date);
                            // Optionally, you can revert the reservation status or throw an exception
                            throw new \Exception('Not enough beds available for reservation: ' . $dorm->id . ' on date: ' . $date);
                        }
                    } else {
                        // If the bed record does not exist, create a new one with initial availability
                        $initialAvailability = (strtolower($gender) === 'male' ? 8 : 11);
                        if ($initialAvailability >= $quantity) {
                            Bed::create([
                                'date' => $date,
                                'gender' => $gender,
                                'availability' => $initialAvailability - $quantity,
                            ]);
                        } else {
                            // Log an error or take appropriate action for insufficient initial availability
                            Log::error('Not enough initial beds available for reservation: ' . $dorm->id . ' on date: ' . $date);
                            // Optionally, you can revert the reservation status or throw an exception
                            throw new \Exception('Not enough initial beds available for reservation: ' . $dorm->id . ' on date: ' . $date);
                        }
                    }
                }
            });
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
