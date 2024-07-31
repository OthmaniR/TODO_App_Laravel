@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Home Page</title>

</head>

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">{{ __('To-Do List') }}</h4>
                </div>


                    <div class="card-body">
                        @if (Session::has('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('alert-success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

              </div>


                    <div class="d-flex justify-content-end mb-4">

                        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-custom">
                            <i class="fas fa-plus"></i> Add a Task
                        </a>
                    </div>

                    @if(isset($tasks) && count($tasks) > 0)
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr id="{{ $task->id }}" class="{{ $task->status === 'Completed' ? 'table-success' : '' }}">
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td class="text-center">
                                        @if ($task->status === 'Completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif ($task->status === 'In progress')
                                            <span class="badge badge-warning text-dark">In Progress</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $task->created_at ? $task->created_at->format('F j, Y \a\t g:i A') : '' }}
                                    </td>


                                    <td class="text-center">
                                        @if ($task->status === 'Completed')
                                            <form action="{{ route('tasks.markAsUncomplete', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm btn-custom">
                                                    <i class="fas fa-undo-alt"></i> Uncomplete
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('tasks.markAsComplete', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm btn-custom">
                                                    <i class="fas fa-check"></i> Complete
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('tasks.editTask', $task->id) }}" class="btn btn-warning btn-sm btn-custom">
                                            <i class="fas fa-edit"></i> Update
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-custom">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <h4>No tasks created yet</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Do you really want to delete this item?');
    }
</script>
@endsection
