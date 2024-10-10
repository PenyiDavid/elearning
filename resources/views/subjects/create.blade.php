@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Subject</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('storeSubject') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject Name</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Subject</button>
    </form>
</div>
@endsection