@extends('layouts.voting')
@section('content')
    <div class="mail-container">
        <!-- Envelope -->
        <div class="envelope">
            <div class="flap"></div>

            <div class= "page-bg">
                <div class="letter">
                    <h2>Thank You for Voting!</h2>
                    <p>Your vote has been successfully recorded.</p>

                    <br>
                    <p class="email-note"><i>A secure confirmation has been sent to your registered email address.</i></p>

                    <div class="actions">
                        <a href="/" class="btn-link">Back to Home</a>
                        <a href="/results" class="btn-link">View Live Results</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // confetti pops!
        setTimeout(() => {
            confetti({
                particleCount: 150,
                spread: 70,
                origin: {
                    y: 0.6
                },
                colors: ['#1a3c6e', '#dc143c', '#ffffff']
            });
        }, 1500);
    </script>
@endsection
