 <?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\CandidatesController;

    //home page
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
    Route::get('/candidates', [CandidatesController::class, 'index']);  //index shows candidates 
    Route::post('/candidates', [CandidatesController::class, 'store']);  //store records votes

    //thankyou
    Route::get('/thank-you', function () {
        return view('thankyou');
    });

    //results
    Route::get('/results', function () {
        $candidates = DB::table('candidates')
            ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id') //LEFT JOIN ensures all candidates are included, even if they have 0 votes
            ->select('candidates.name', 'candidates.party', DB::raw('COUNT(votes.id) as votes'))  //tells DB to count votes for each candidate and label it as votes
            ->groupBy('candidates.id', 'candidates.name', 'candidates.party')
            ->orderByDesc('votes') //Sorts highest → lowest, makes leader appear first 
            ->get();  //contains all candidates with their vote count.

        return view('results', compact('candidates'));  //['candidates' => $candidates]
    });
