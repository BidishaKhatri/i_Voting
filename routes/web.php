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

    // 🔐 All protected routes
    Route::middleware(['voter'])->group(function () {
        // BIOMETRIC PAGE
        Route::get('/biometric', function () {
            return view('biometric');
        });

        // VERIFY FACE (placeholder)
        Route::post('/verify-face', function (Request $request) {

            session(['biometric_verified' => true]);
            // For now, always verify
            return response()->json(['status' => 'verified']);
        });
    });

    //candidates : 🗳️ Voting (only once)
    Route::middleware(['voter', 'biometric', 'notvoted'])->group(function () {
        Route::get('/candidates', [CandidatesController::class, 'index']);
        Route::post('/candidates', [CandidatesController::class, 'store']);
    });

    //thankyou
    Route::get('/thank-you', function () {
        return view('thankyou');
    });

    //results
    Route::middleware(['voter', 'biometric', 'results'])->group(function () {
        Route::get('/results', function () {
            $candidates = DB::table('candidates')
                ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id') //LEFT JOIN ensures all candidates are included, even if they have 0 votes
                ->select('candidates.name', 'candidates.party', DB::raw('COUNT(votes.id) as votes'))  //tells DB to count votes for each candidate and label it as votes
                ->groupBy('candidates.id', 'candidates.name', 'candidates.party')
                ->orderByDesc('votes') //Sorts highest → lowest, makes leader appear first 
                ->get();  //contains all candidates with their vote count.

            return view('results', compact('candidates'));  //['candidates' => $candidates]
        });
    });
