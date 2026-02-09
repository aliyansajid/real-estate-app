<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ListingExpiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $listing;

    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function build()
    {
        return $this->view('emails.listing_expiry')
                    ->subject('Your Listing is About to Expire')
                    ->with([
                        'listingTitle' => $this->listing->title,
                        'expiryDate' => $this->listing->expiry_date->format('Y-m-d'),
                        'reactivationLink' => route('listing.reactivate', ['id' => $this->listing->id]),
                    ]);
    }
}
