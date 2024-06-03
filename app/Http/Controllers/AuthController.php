<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Attempt authentication against the users table
        if (Auth::attempt($credentials)) {
            Auth::user()->update(['is_online' => 1]);
            return redirect()->route('admin.dashboard');
        }
    
        // If authentication against users table fails, attempt against sponsors table
        $sponsorCredentials = $request->only('email', 'password');
        if (Auth::guard('sponsor')->attempt($sponsorCredentials)) {
            // Optionally, update sponsor status or perform any specific actions
            return redirect()->route('sponsor.dashboard');
        }
    
        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
