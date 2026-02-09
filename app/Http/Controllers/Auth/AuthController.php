<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Listing;
use Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
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
            return redirect()->intended('dashboard/agent')
                        ->withSuccess('You have Successfully logged-in');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:11',
            'password' => 'required|min:8',
            'city' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/agents', 'public');
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'city' => $request->input('city'),
            'image' => $imagePath,
            'role' => $request->input('role'),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.agent')->withSuccess('Registration successful!');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $listings = Listing::where('agent_id', Auth::id())->get();

            return view('dashboard.agent.index', compact('listings'));
        }

        return redirect('login')->withErrors('Oops! You do not have access');
    }

    public function admin()
    {
        if (Auth::check()) {
            return view('admin.index');
        }

        return redirect('admin/login')->withErrors('Oops! You do not have access');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'city' => $data['city'] ?? null,
            'image' => $data['image'] ?? null,
            'role' => $data['role'],
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
