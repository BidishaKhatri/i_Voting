@extends('layouts.voting')

@section('content')
    <div class="biometric-container">

        <h2 class="page-title">Biometric Verification</h2>
        <p>Hello {{ session('voter_name') ?? '' }}, please verify your face to continue.</p>

        <video id="video" autoplay></video>
        <br>

        <!-- Snapshot preview -->
        <img id="snapshot" alt="Face Snapshot">
        <button class="vote-button" onclick="capture()">Verify Face</button>

        <canvas id="canvas" style="display:none;"></canvas>
        <!-- Placeholder message -->
        <div id="message"></div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/biometric.js') }}"></script>
@endsection
