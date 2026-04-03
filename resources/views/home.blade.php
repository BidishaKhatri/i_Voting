{{-- @extends('layouts.voting')
@section('content')
    <div class="home-page">
        <img src="{{ asset('css/images/ballot_box.jpg') }}" alt="Ballot Box" class="ballot">
        <p class="subtitle">Secure, fast, and accessible voting at your fingertips.</p>
        <h2 class="page-title">Welcome to the Online Voting System</h2>
        <p>Please login using your citizenship ID to continue.</p>
        <a href="/login" class="btn btn-primary vote-button">Login to Vote</a> <!--bootsrap-->
    </div>
@endsection --}}

@extends('layouts.voting')
@section('content')
    <div class="home-page">

        <img src="{{ asset('css/images/ballot_box.jpg') }}" class="ballot">

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
                <li>Login using your Citizenship ID</li>
                <li>Select your candidate</li>
                <li>Submit your vote securely</li>
            </ul>
        </div>

        <a href="/login" class="btn btn-primary vote-button">
            Login & Cast Your Vote
        </a>

        <p class="footer-note">
            © 2026 Election Commission
        </p>

    </div>
@endsection
