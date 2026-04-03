 <?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\CandidatesController;

    Route::get('/', function () {
        return view('home');
    })->name('home');

    //login page
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);

    // BIOMETRIC PAGE
    Route::get('/biometric', function () {
        // Make sure a voter is logged in
        if (!session()->has('voter_id')) {
            return redirect('/login');
        }
        return view('biometric');
    });

    // VERIFY FACE (placeholder)
    Route::post('/verify-face', function (Request $request) {
        if (!session()->has('voter_id')) {
            return response()->json(['status' => 'failed']);
        }

        // For now, always verify
        return response()->json(['status' => 'verified']);
    });

    //Candidates
    Route::get('/candidates', [CandidatesController::class, 'index']);
    Route::post('/candidates', [CandidatesController::class, 'store']);

    //thankyou
    Route::get('/thank-you', function () {
        return view('thankyou');
    });

    //results
    //Counts votes ,Sorts highest → lowest , Makes leader appear first 
    Route::get('/results', function () {
        $candidates = DB::table('candidates')
            ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
            ->select('candidates.name', 'candidates.party', DB::raw('COUNT(votes.id) as votes'))
            ->groupBy('candidates.id', 'candidates.name', 'candidates.party')
            ->orderByDesc('votes') // leaderboard (highest first)
            ->get();

        return view('results', compact('candidates'));
    });
