<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $cities = User::where('role', 'agent')
                    ->whereNotNull('city')
                    ->distinct()
                    ->pluck('city');

        $query = User::where('role', 'agent');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', $request->input('city'));
        }

        $agents = $query->withCount('listings')->get();

        return view('agents.index', compact('agents', 'cities'));
    }

    public function show($id)
    {
        $agent = User::withCount('listings')->findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    public function send(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
            'phone' => 'nullable|string|max:15',
        ]);

        $agent = User::where('role', 'agent')->findOrFail($id);

        $details = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? 'Not Provided',
            'message' => $validated['message'],
            'subject' => 'New Inquiry for Agent: ' . $agent->name,
        ];

        try {
            Mail::to($agent->email)->send(new ContactMail($details));
            return back()->with('success', 'Your message has been sent to the agent.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            return back()->withErrors('There was an error sending your message. Please try again later.');
        }
    }
}
