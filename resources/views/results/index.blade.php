@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Results</h1>
    <p>Email: <strong>{{ $email }}</strong></p>
    <p>Total Score: <strong>{{ $totalScore }}</strong></p>
    <p>Obtained Score: <strong>{{ $obtainedScore }}</strong></p>
    <p>Percentage: <strong>{{ number_format($percentage, 2) }}%</strong></p>

    <h2>Results:</h2>
    <ul class="list-group">
        @foreach($results as $result)
            <li class="list-group-item">
                {{ $result->question->question }} - Your answer: 
                <span style="color: {{ $result->is_correct ? 'green' : 'red' }}">
                    {{ $result->answer->answer }}
                </span>
                @if (!$result->is_correct)
                    <span class="text-warning"> (Correct: {{ $result->question->answers->where('is_correct', true)->first()->answer }})</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection