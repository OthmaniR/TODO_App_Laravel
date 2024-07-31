@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="statistics-card">
                    <h2>Daily Statistics</h2>
                    <p><strong>Completion Rate:</strong> {{ number_format($completionRate, 2) }}%</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="statistics-card">
                    <h2>Weekly Statistics</h2>
                    <p><strong>Completion Rate:</strong> {{ number_format($completionRate, 2) }}%</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="statistics-card">
                    <h2>Monthly Statistics</h2>
                    <p><strong>Completion Rate:</strong> {{ number_format($completionRate, 2) }}%</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="statistics-card">
                    <h2>Average Completion Time</h2>
                    <p><strong>Time:</strong> {{ $averageCompletionTime }} minutes</p>
                </div>
            </div>
        </div>
    </div>
@endsection
