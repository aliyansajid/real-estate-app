<?php

namespace App\Console\Commands;

use App\Mail\ListingExpiryNotification;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendListingExpiryEmails extends Command
{
    protected $signature = 'listings:send-expiry-emails';
    protected $description = 'Send emails to agents about listings about to expire';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $listings = Listing::whereDate('expiry_date', now()->addDays(3)->toDateString())
                            ->where('status', 'active')
                            ->get();

        foreach ($listings as $listing) {
            Mail::to($listing->agent->email)->send(new ListingExpiryNotification($listing));
        }

        $this->info('Expiry emails sent successfully!');
    }
}
