@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Question</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('updateQuestion', $question->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control" value="{{ $question->question }}" required>
        </div>

        <div class="form-group">
            <label for="subject_id">Select Subject</label>
            <select name="subject_id" class="form-control" required>
                <option value="" disabled>Select a subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $question->subject_id ? 'selected' : '' }}>{{ $subject->subject }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="score">Score for Question</label>
            <input type="number" name="score" class="form-control" value="{{ $question->score }}" required>
        </div>

        <h5>Answers</h5>
        @foreach($question->answers as $index => $answer)
            <div class="answer-group">
                <div class="form-group">
                    <input type="text" name="answers[{{ $index }}][answer]" class="form-control" value="{{ $answer->answer }}" required>
                    <input type="checkbox" name="answers[{{ $index }}][is_correct]" value="1" {{ $answer->is_correct ? 'checked' : '' }}> Correct Answer
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Update Question</button>
    </form>
</div>
@endsection