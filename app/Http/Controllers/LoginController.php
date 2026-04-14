<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // login.blade.php
    }

    public function login(Request $request)
    {
        // Validates that both fields are provided before processing.
        $request->validate([
            'citizenship_no' => 'required',
            'voter_id' => 'required',
        ]);

        $user = DB::table('users')
            ->where('citizenship_no', $request->citizenship_no)
            ->first();

        if (!$user) {
            return back()->withErrors(['Invalid citizenship number']);
        }

        // now check voter_id separately
        if (!$user->voter_id) {
            return back()->withErrors(['You do not have a voter ID yet']);
        }

        if ($user->voter_id != $request->voter_id) {
            return back()->withErrors(['Citizenship and voter ID do not match']);
        }

        if ($user->age < 18) {
            return back()->withErrors(['You must be 18+ to vote.']);
        }

        if ($user->has_voted) {
            return back()->withErrors(['You have already voted.']);
        }

        // Stores user info in session so they stay logged in.
        session([
            'voter_id' => $user->id,
            'voter_name' => $user->first_name,
            'has_voted' => $user->has_voted,
            'biometric_verified' => false,
        ]);

        return redirect('/biometric');
    }

    // Logout clears the session to prevent unauthorized access, especially on shared devices.
    public function logout()
    {
        //session()->forget('voter_id');
        session()->flush();
        return redirect('/login');
    }
}
