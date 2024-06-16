<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dorm;
use App\Models\Bed;

class RefreshBedAvailability extends Command
{
   
    protected $signature = 'beds:update';

    protected $description = 'Update beds availability based on expired reservations';

   
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredReservations = Dorm::whereDate('reservation_end_date', '<', now())
            ->where('status', 'Reserved')
            ->get();

        foreach ($expiredReservations as $reservation) {
            $bed = Bed::where('gender', $reservation->gender)->first();

            if ($bed) {
                $bed->availability += $reservation->quantity;
                $bed->save();
            }

            // Optionally, you can update the reservation status here
            $reservation->status = 'Expired';
            $reservation->save();
        }

        $this->info('Beds availability updated successfully.');
    
    }
}
