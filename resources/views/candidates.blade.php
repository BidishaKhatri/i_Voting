@extends('layouts.voting')

@section('content')
    <div class="candidates-page">

        <h2 class="page-title">Choose Your Candidate</h2>

        <p>Please select one candidate to vote.</p>

        <div class="row justify-content-center">

            @foreach ($candidates as $candidate)
                <div class="col-md-4">
                    <div class="card mb-4">
                        {{-- Dynamically loads candidate image based on their ID. --}}
                        <img src="{{ asset('css/images/' . $candidate->id . '.jpg') }}" class="card-img-top"
                            alt="Candidate Photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidate->name }}</h5>

                            <div class="party-info">
                                {{-- Converts party name into a filename-friendly format. --}}
                                <img src="{{ asset('css/images/parties/' . str_replace(' ', '-', strtolower($candidate->party)) . '.png') }}"
                                    class="party-icon" alt="Party Logo">
                                {{-- <p class="card-text">{{ $candidate->party }}</p> --}}
                                <span class="card-text">{{ $candidate->party }}</span>
                            </div>

                            <div class="bio-section">
                                <a href="https://en.wikipedia.org/wiki/{{ str_replace(' ', '_', $candidate->name) }}"
                                    target="_blank" class="btn btn-outline-info btn-sm">
                                    View Bio
                                </a>
                            </div>

                            {{-- Sends vote request to backend. --}}
                            <form method="POST" action="/candidates">
                                @csrf
                                {{-- Sends selected candidate ID to backend. --}}
                                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}" required>
                                <button type="submit" class="btn btn-success">Vote</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
