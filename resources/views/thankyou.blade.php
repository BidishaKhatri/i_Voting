@extends('layouts.voting')
@section('content')
    <div class="mail-container">

        <!-- Envelope -->
        <div class="envelope">
            <div class="flap"></div>

            <div class="letter">
                <h2>Thank You for Voting!</h2>
                <p>Your vote has been successfully recorded.</p>

                <div class="actions">
                    <a href="/" class="btn-link">Back to Home</a>
                    <a href="/results" class="btn-link">View Live Results</a>
                </div>
            </div>
        </div>

    </div>
@endsection
