<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Illuminate\Console\Command;

class UpdateExpiredListings extends Command
{
    protected $signature = 'listings:update-expired';
    protected $description = 'Mark expired listings as inactive';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get listings where the expiry date has passed and status is still 'active'
        $expiredListings = Listing::where('expiry_date', '<', now())
                                  ->where('status', 'active')
                                  ->get();

        foreach ($expiredListings as $listing) {
            // Update the listing status to 'inactive'
            $listing->update(['status' => 'inactive']);
        }

        $this->info('Expired listings updated to inactive status.');
    }
}
