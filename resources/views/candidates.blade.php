@extends('layouts.voting')

@section('content')
    <div class="candidates-page">

        <h2 class="page-title">Choose Your Candidate</h2>

        <p>Please select one candidate to vote.</p>

        <div class="row justify-content-center">

            @foreach ($candidates as $candidate)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('css/images/' . $candidate->id . '.jpg') }}" class="card-img-top"
                            alt="Candidate Photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidate->name }}</h5>

                            <div class="party-info">
                                <img src="{{ asset('css/images/parties/' . str_replace(' ', '-', strtolower($candidate->party)) . '.png') }}"
                                    class="party-icon" alt="Party Logo">
                                {{-- <p class="card-text">{{ $candidate->party }}</p> --}}
                                <span class="card-text">{{ $candidate->party }}</span>
                            </div>

                            <form method="POST" action="/candidates">
                                @csrf
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
