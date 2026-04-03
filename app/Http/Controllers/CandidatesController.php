<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate;
use Illuminate\Support\Facades\Mail;

class CandidatesController extends Controller
{
    public function index()
    {
        if (!session()->has('voter_id')) {
            return redirect('/login');
        }

        $voter = DB::table('users')->where('id', session('voter_id'))->first();


        if ($voter->has_voted) {
            return redirect('/thank-you')->with('error', 'You have already voted.');
        }

        $candidates = Candidate::all();
        return view('candidates', compact('candidates'));
    }

    public function store(Request $request)
    {
        // check session first
        if (!session()->has('voter_id')) {
            return redirect('/login');
        }

        //get voter id 
        $voterId = session('voter_id');

        //check if voted before or not
        $voter = DB::table('users')->where('id', session('voter_id'))->first();

        if ($voter->has_voted) {
            return redirect('/candidates')->with('error', 'You have already voted.');
        }

        // Validate input
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Save vote
        DB::table('votes')->insert([
            'candidate_id' => $request->candidate_id,
            'voter_id' => $voterId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Mark user as voted
        DB::table('users')
            ->where('id', $voterId)
            ->update(['has_voted' => 1]);

        // Send email
        $voter = DB::table('users')->where('id', $voterId)->first();

        Mail::raw('Thank you for voting. Your vote has been successfully recorded.', function ($message) use ($voter) {
            $message->to($voter->email)
                ->subject('Vote Confirmation');
        });

        return redirect('/thank-you');
    }
}
