@extends('layouts.voting')

@section('content')
    <div class= "page-bg">
        <div class="text-center">
            <h2>📊 Live Election Results</h2>
        </div>


        <div style="width: 70%; margin: auto; margin-top: 20px;">
            <canvas id="resultsChart"></canvas>
        </div>

        @php
            $names = $candidates->pluck('name');
            $votes = $candidates->pluck('votes');
        @endphp

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
                        {{-- Highlights the candidate in first place with a special CSS class. --}}
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('resultsChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($names) !!},
                    datasets: [{
                        label: 'Votes',
                        data: {!! json_encode($votes) !!},
                        backgroundColor: ['#1cc88a', '#4e73df', '#36b9cc', '#f6c23e', '#e74a3b', '#858796']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
            setTimeout(() => location.reload(), 60000); //updates every 60 sec.
        </script>
    </div>
@endsection
