@extends('layouts.voting')

@section('content')
    <div class="biometric-container">

        <h2 class="page-title">Biometric Verification</h2>
        <p>Hello {{ session('voter_name') ?? '' }}, please verify your face to continue.</p>

        <div class="camera-wrapper">
            {{-- Displays the live camera feed. --}}
            <video id="video" autoplay></video>
            {{-- Shows a circular guide to align the face for verification. --}}
            <div class="oval-overlay"></div>
        </div>
        <br>

        {{-- Calls a JavaScript function capture() in biometric.js when clicked --}}
        <button class="vote-button" onclick="capture()">Verify Face</button>


        {{-- Hidden canvas used to capture the video frame for verification.
        The JS takes a snapshot from the video 
        and can send it to the server or simulate verification. --}}

        <canvas id="canvas" style="display:none;"></canvas>
        <!-- Placeholder message -->
        <div id="message"></div>

    </div>
@endsection

{{-- Includes page-specific JavaScript for biometric logic --}}
@section('scripts')
    <script src="{{ asset('js/biometric.js') }}"></script>
@endsection
