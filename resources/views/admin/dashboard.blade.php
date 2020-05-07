@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-4 col-md-4">
                <div class="card">
                    <h5 class="card-header">Statistics</h5>
                    <div class="card-body">
                        <p class="card-text">Quizzes: {{ $quizzes->count() }}</p>
                        <p class="card-text">Questions: {{ $questions->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
