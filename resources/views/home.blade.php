@extends('layouts.voting')

@section('content')
    <div class="dashboard">

        <!-- LEFT SIDEBAR -->
        <div class="sidebar">
            <h3>Welcome to i-Voting!</h3>

            <p class="vote-msg">Your Vote Matters!</p>


            <div class="status green">
                ✔ Voting Status: Open
            </div>

            <div class="status red">
                ✖ User Not Authenticated
            </div>

            <!-- Ballot box at bottom -->
            <div class="ballot-box">
                <img src="{{ asset('css/images/ballot_box.jpg') }}">
            </div>
        </div>


        <!-- CENTER CONTENT -->
        <div class="main-content">

            <h2>Official Online Voting Portal</h2>

            <p class="subtitle">
                Secure, fast, and accessible voting at your fingertips.
            </p>

            <p class="trust-text">
                This platform ensures secure and transparent digital voting for all eligible citizens.
            </p>

            <div class="how-it-works">
                <h3>How It Works</h3>
                <ul>
                    <li>✅ Login using your Voter ID</li>
                    <li>✅ Ferify your face</li>
                    <li>✅ View candidates</li>
                    <li>✅ Cast your vote securely</li>
                    <li>✅ View Live Results</li>
                </ul>
            </div>

            <a href="/login" class="btn go-vote">Login to Vote</a>

        </div>


        <!-- RIGHT PANEL (Candidates Preview) -->
        <div class="right-panel">

            <h3>2026 elected Candidates</h3>
            <div class="candidate-preview">
                <img src="{{ asset('css/images/1.jpg') }}">
                <div>
                    <h4>Balen Shah</h4>
                    <p>Championing urban reform and digital transparency.</p>
                    <a href="https://en.wikipedia.org/wiki/Balen_Shah" target="_blank" class="read-more-link">Read
                        More</a>
                </div>
            </div>

            <div class="candidate-preview">
                <img src="{{ asset('css/images/2.jpg') }}">
                <div>
                    <h4>Gagan Thapa</h4>
                    <p>Advocating for healthcare reform and structural government change.</p>
                    <a href="https://en.wikipedia.org/wiki/Gagan_Thapa" target="_blank" class="read-more-link">Read
                        More</a>
                </div>
            </div>

            <div class="candidate-preview">
                <img src="{{ asset('css/images/3.jpg') }}">
                <div>
                    <h4>Harka Sampang</h4>
                    <p>Leading grassroots initiatives for water security and social labor.</p>
                    <a href="https://en.wikipedia.org/wiki/Harka_Sampang" target="_blank" class="read-more-link">Read
                        More</a>
                </div>
            </div>

            <a href="#" class="view-all" onclick="showLoginMsg(event)">
                View All Candidates →
            </a>

            <p id="login-msg" style="display: none;">
                Please login to explore all candidates and cast your vote.
            </p>

        </div>
    </div>
@endsection

<script>
    function showLoginMsg(event) {
        // This prevents the page from jumping or refreshing
        event.preventDefault();

        var msg = document.getElementById("login-msg");
        if (msg) {
            msg.style.display = "block";
        }
    }
</script>
