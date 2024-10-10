@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Questions List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('createQuestion') }}" class="btn btn-primary mb-3">Add New Question</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->subject->name }}</td>
                    <td>
                        <a href="{{ route('editQuestion', $question->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('destroyQuestion', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection