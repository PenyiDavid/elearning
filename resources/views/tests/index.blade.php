@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Select a Test</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($subjects as $subject)
    <form action="{{ route('startTeszt', $subject->subject) }}" method="POST" id="testForm">
        @csrf
        <div class="form-group">
            <label for="subject">Choose a Subject</label>
            <select name="subject" id="subject" class="form-control" required>
                <option value="" disabled selected>Select a subject</option>
                    <option value="{{ $subject->subject }}">{{ $subject->subject }}</option>
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Start Test</button>
    </form>   
    @endforeach 
</div>
@endsection