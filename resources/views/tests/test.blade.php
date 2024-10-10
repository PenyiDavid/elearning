@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Test: {{ $subjectModel->name }}</h1>

    <form action="{{ route('submitTeszt') }}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subjectModel->id }}">
        <div class="list-group">
            @foreach($questions as $question)
                <div class="list-group-item">
                    <h5>{{ $question->question }}</h5>
                    <div class="form-group">
                        <select name="answers[{{ $question->id }}]" class="form-control" required>
                            <option value="" disabled selected>Select an answer</option>
                            @foreach($question->answers as $answer)
                                <option value="{{ $answer->id }}">{{ $answer->answer }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit Test</button>
    </form>
</div>
@endsection