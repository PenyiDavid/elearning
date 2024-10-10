@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Select a Test</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('startTeszt', ['tantargy' => '']) }}" method="POST" id="testForm">
        @csrf
        <div class="form-group">
            <label for="subject">Choose a Subject</label>
            <select name="subject" class="form-control" required>
                <option value="" disabled selected>Select a subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Start Test</button>
    </form>
</div>
@endsection