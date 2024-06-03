<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $users = User::all();
        $sponsor = Sponsor::all();
        
        // Update status of events where end date is less than current date
        foreach ($events as $event) {
            if (Carbon::now()->greaterThan($event->end)) {
                $event->update(['status' => 'completed']);
            }
        }
        
        return view('admin.index', compact('events', 'users', 'sponsor'));
    }
    public function profile()
    {
        return view('profile.profile');
    }
    public function updateProfile(Request $request)
    {  
        $user = Auth::user();
          
        // Update user's full name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Upload profile image if provided
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images/profile-images', $fileName); // Change the storage path as needed
            $user->profile_photo_path = $fileName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(['password' => 'The current password is incorrect']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('newpassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
