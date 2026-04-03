@extends('layouts.voting')

@section('content')
    <div class="text-center">
        <h2>📊 Live Election Results</h2>
    </div>

    {{-- <div class="container" style="margin-top: 30px;"> --}}
    <div class="results-full">

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Candidate</th>
                    <th>Party</th>
                    <th>Votes</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($candidates as $index => $candidate)
                    <tr class="{{ $index == 0 ? 'winner-row' : '' }}">

                        <td>
                            @if ($index == 0)
                                🏆 1
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>

                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->party }}</td>
                        <td>{{ $candidate->votes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<script>
    setTimeout(() => location.reload(), 5000); //updates every 5 sec.
</script>
