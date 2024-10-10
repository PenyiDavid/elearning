@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Question</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('storeQuestion') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="subject_id">Select Subject</label>
            <select name="subject_id" class="form-control" required>
                <option value="" disabled selected>Select a subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="score">Score for Question</label>
            <input type="number" name="score" class="form-control" required>
        </div>

        <h5>Answers</h5>
<div class="answer-group">
    <div class="form-group">
        <input type="text" name="answers[0][answer]" class="form-control" placeholder="Answer 1" required>
        <input type="hidden" name="answers[0][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[0][is_correct]" value="1"> Correct Answer
    </div>
    <div class="form-group">
        <input type="text" name="answers[1][answer]" class="form-control" placeholder="Answer 2" required>
        <input type="hidden" name="answers[1][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[1][is_correct]" value="1"> Correct Answer
    </div>
    <div class="form-group">
        <input type="text" name="answers[2][answer]" class="form-control" placeholder="Answer 3"> <!-- Nincs required -->
        <input type="hidden" name="answers[2][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[2][is_correct]" value="1"> Correct Answer
    </div>
    <div class="form-group">
        <input type="text" name="answers[3][answer]" class="form-control" placeholder="Answer 4"> <!-- Nincs required -->
        <input type="hidden" name="answers[3][is_correct]" value="0"> <!-- Rejtett mező 0 értékkel -->
        <input type="checkbox" name="answers[3][is_correct]" value="1"> Correct Answer
    </div>
</div>

        <button type="submit" class="btn btn-success mt-3">Add Question</button>
    </form>
</div>
@endsection