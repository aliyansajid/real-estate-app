<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id',
        'title',
        'description',
        'area',
        'bedrooms',
        'bathrooms',
        'garage',
        'garage_count',
        'year_built',
        'purpose',
        'price',
        'price_per_month',
        'address',
        'city',
        'state',
        'zip_code',
        'property_type',
        'images',
        'video_link',
        'location_link',
        'features',
        'expiry_date',
        'status',
        'inactive_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiry_date' => 'datetime',
        'images' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'price_per_month' => 'decimal:2',
    ];

    /**
     * Get the agent associated with the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
