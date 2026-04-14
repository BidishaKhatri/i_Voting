@extends('layouts.voting')

@section('content')
    <div class="page-bg">
        <div class="login-box">
            <h2 class="page-title">Voter Login</h2>

            {{-- Displays validation errors returned from the backend. --}}
            <div class="error-container">
                @foreach ($errors->all() as $error)
                    <p class="error-msg">{{ $error }}</p>
                @endforeach
            </div>

            {{-- Sends login data securely to the /login route. --}}
            <form method="POST" action="/login">
                @csrf

                <div class="input-group">
                    <label>Citizenship Number</label><br>
                    <input type="text" name="citizenship_no" placeholder="Enter your citizenship number." required>
                </div>
                <br><br>

                <div class="input-group">
                    <label for="voter_id">Voter ID</label>
                    <input type="text" name="voter_id" id="voter_id" placeholder="Enter your voter id"required>
                </div>

                <!--continue buttons-->
                <div class="continue-btn">
                    <button class="btn btn-primary vote-button">Continue</button>
                </div>
            </form>
        </div>
    @endsection
