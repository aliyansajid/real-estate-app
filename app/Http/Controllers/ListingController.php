<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Auth;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::query();

        // Only show active listings
        $query->where('status', 'active');

        if ($request->has('status') && $request->status != '') {
            $query->where('purpose', $request->status);
        }
        if ($request->has('type') && $request->type != '') {
            $query->where('property_type', $request->type);
        }        
        if ($request->has('bedrooms') && $request->bedrooms != '') {
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->has('bathrooms') && $request->bathrooms != '') {
            $query->where('bathrooms', $request->bathrooms);
        }
        if ($request->has('area') && $request->area != '') {
            $query->where('area', '>=', $request->area);
        }
        if ($request->has('location') && $request->location != '') {
            $query->where('city', 'like', '%' . $request->location . '%');
        }
        if ($request->has('price_range') && $request->price_range != '') {
            $delimiter = strpos($request->price_range, ';') !== false ? ';' : '-';
            $range = explode($delimiter, $request->price_range);
        
            if (count($range) === 2) {
                $minPrice = floatval(trim($range[0]));
                $maxPrice = floatval(trim($range[1]));
        
                if ($request->status === 'sale') {
                    $query->whereBetween('price', [$minPrice, $maxPrice]);
                }
                elseif ($request->status === 'rent') {
                    $query->whereBetween('price_per_month', [$minPrice, $maxPrice]);
                }
                else {
                    $query->where(function ($q) use ($minPrice, $maxPrice) {
                        $q->whereBetween('price', [$minPrice, $maxPrice])
                        ->orWhereBetween('price_per_month', [$minPrice, $maxPrice]);
                    });
                }
            } else {
                Log::warning('Invalid price range format: ' . $request->price_range);
            }
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'low_high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'high_low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest_first':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest_first':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        }

        // Execute the query and get the listings
        $listings = $query->get();

        return view('listings.index', compact('listings'));
    }

    public function showListing($id)
    {
        $listing = Listing::with('agent')->findOrFail($id);
    
        $similarProperties = Listing::where('id', '!=', $listing->id)
                                     ->where('city', $listing->city)
                                     ->where('property_type', $listing->property_type)
                                     ->whereBetween('price', [
                                         $listing->price * 0.9,
                                         $listing->price * 1.1
                                     ])
                                     ->limit(5)
                                     ->get();
    
        return view('listings.show', compact('listing', 'similarProperties'));
    }    
    
    public function create()
    {
        return view('dashboard.agent.listings.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add a listing.');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'area' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'garage' => 'required|string|in:yes,no',
            'garage_count' => 'nullable|integer',
            'year_built' => 'required|integer|min:1900|max:' . date('Y'),
            'purpose' => 'required|string|in:rent,sale',
            'price' => 'nullable|numeric',
            'price_per_month' => 'nullable|numeric',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'property_type' => 'required|string|in:house,apartment,commercial,villa,land,others',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'parking_spaces_count' => 'nullable|integer|min:0',
            'floors_count' => 'nullable|integer|min:0',
            'store_rooms_count' => 'nullable|integer|min:0',
            'dining_room_count' => 'nullable|integer|min:0',
            'bedrooms_count' => 'nullable|integer|min:0',
            'bathrooms_count' => 'nullable|integer|min:0',
            'servant_quarters_count' => 'nullable|integer|min:0',
            'kitchens_count' => 'nullable|integer|min:0',
        ]);
    
        $data = $request->only([
            'title', 'description', 'area', 'bedrooms', 'bathrooms',
            'garage', 'garage_count', 'year_built', 
            'purpose', 'price', 'price_per_month', 'address', 
            'city', 'state', 'zip_code', 'property_type', 
            'video_link', 'location_link'
        ]);
    
        $data['agent_id'] = Auth::id();

        $data['expiry_date'] = now()->addDays(30)->format('Y-m-d');
    
        $features = $request->input('features', []);
        $featureData = [];
    
        foreach ($features as $feature) {
            $countKey = strtolower(str_replace(' ', '_', $feature)) . '_count';
    
            if ($request->has($countKey)) {
                $featureData[$feature] = $request->input($countKey, 0);
            } else {
                $featureData[$feature] = true;
            }
        }
    
        $data['features'] = json_encode($featureData);
    
        if ($request->hasFile('images')) {
            $images = [];
            $listingFolder = 'uploads/property_images/' . Auth::id();
            
            foreach ($request->file('images') as $image) {
                $path = $image->store($listingFolder, 'public');
                $images[] = $path;
            }
            $data['images'] = json_encode($images);
        }
    
        Listing::create($data);
    
        return redirect()->route('dashboard.agent')->with('success', 'Listing created successfully.');
    }

    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return view('dashboard.agent.listings.show', compact('listing'));
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        $features = $listing->features ? json_decode($listing->features, true) : [];
    
        return view('dashboard.agent.listings.edit', compact('listing', 'features'));
    }
    
    public function update(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'area' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'garage' => 'required|string',
            'year_built' => 'required|numeric|min:1900|max:' . date('Y'),
            'purpose' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'property_type' => 'required|string|in:house,apartment,commercial,villa,land,others',
            'images.*' => 'nullable|image|max:2048',
            'video_link' => 'nullable|url',
            'location_link' => 'nullable|url',
        ]);

        $listing->title = $request->title;
        $listing->description = $request->description;
        $listing->area = $request->area;
        $listing->bedrooms = $request->bedrooms;
        $listing->bathrooms = $request->bathrooms;
        $listing->garage = $request->garage;
        $listing->garage_count = $request->garage === 'yes' ? $request->garage_count : null;
        $listing->year_built = $request->year_built;
        $listing->purpose = $request->purpose;
        $listing->price = $request->purpose === 'sale' ? $request->price : null;
        $listing->price_per_month = $request->purpose === 'rent' ? $request->price_per_month : null;
        $listing->address = $request->address;
        $listing->city = $request->city;
        $listing->state = $request->state;
        $listing->zip_code = $request->zip_code;
        $listing->property_type = $request->property_type;

        if ($request->has('video_link')) {
            $listing->video_link = $request->video_link;
        }

        if ($request->has('location_link')) {
            $listing->location_link = $request->location_link;
        }

        $features = $request->input('features', []);
        $featureData = [];

        foreach ($features as $feature) {
            $countKey = strtolower(str_replace(' ', '_', $feature)) . '_count';
            
            if ($request->has($countKey)) {
                $featureData[$feature] = $request->input($countKey, 0);
            } else {
                $featureData[$feature] = true;
            }
        }

        $listing->features = json_encode($featureData);

        if ($request->hasFile('images')) {
            $images = [];
            $listingFolder = 'uploads/property_images/' . Auth::id();
            foreach ($request->file('images') as $image) {
                $path = $image->store($listingFolder, 'public');
                $images[] = $path;
            }
            $listing->images = json_encode($images);
        }

        $listing->save();

        return redirect()->route('dashboard.agent')->with('success', 'Listing updated successfully.');
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('dashboard.agent')->with('success', 'Listing deleted successfully.');
    }

    public function reactivate($id)
    {
        $listing = Listing::findOrFail($id);

        if ($listing->agent_id !== Auth::id()) {
            return redirect()->route('dashboard.agent')->with('error', 'You do not own this listing.');
        }

        $listing->status = 'active';
        $listing->expiry_date = now()->addDays(30);
        $listing->save();

        return redirect()->route('dashboard.agent')->with('success', 'Listing reactivated successfully!');
    }
}
