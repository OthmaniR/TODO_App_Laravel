@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Task</title>
</head>

@section('content')
<div class="container mt-5">
    <h2>Edit Task</h2>
    <form method="POST" action="{{ route('tasks.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="task_id" value="{{ $task->id }}">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('tasks.list') }}'">Cancel</button>
    </form>
</div>
@endsection
