<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Listing;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $users = User::all();
            return view('admin.index', compact('user', 'users'));
        }

        return redirect('admin/login')->withErrors('Oops! You do not have access');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin')
                        ->withSuccess('You have Successfully logged-in');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }

    public function showUser($id)
    {
        $user = Auth::user();
        $selectedUser  = User::findOrFail($id);
        return view('admin.users.show', compact('user', 'selectedUser'));
    }

    public function editUser($id)
    {
        $user = Auth::user();
        $selectedUser  = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'selectedUser'));
    }

    public function updateUser(Request $request, $id)
    {
        $selectedUser = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $selectedUser->name = $request->name;
        $selectedUser->phone = $request->phone;
        $selectedUser->city = $request->city;
        $selectedUser->description = $request->description;
    
        if ($request->password) {
            $selectedUser->password = Hash::make($request->password);
        }
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/users', 'public');
            $selectedUser->image = $imagePath;
        }
    
        $selectedUser->save();
    
        return redirect()->route('admin')->with('success', 'User updated successfully');
    }

    public function destroyUser($id)
    {
        $user = Auth::user();
        $selectedUser  = User::findOrFail($id);
        $selectedUser ->delete();
        return redirect()->route('admin')->with('success', 'User deleted successfully.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('admin/login');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('uploads/admin', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    public function listings()
    {
        $user = Auth::user();
        $listings = Listing::all();
        return view('admin.listings.index', compact('user', 'listings'));
    }
    
    public function show($id)
    {
        $user = Auth::user();
        $listing = Listing::findOrFail($id);
        return view('admin.listings.show', compact('user', 'listing'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $listing = Listing::findOrFail($id);
        $features = $listing->features ? json_decode($listing->features, true) : [];
    
        return view('admin.listings.edit', compact('user', 'listing', 'features'));
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

        return redirect()->route('admin')->with('success', 'Listing updated successfully.');
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('admin')->with('success', 'Listing deleted successfully.');
    }
}
