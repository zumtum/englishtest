@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Add quiz @endslot
            @slot('parent') Home @endslot
            @slot('active') Quiz @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.quiz.store')}}" method="post">
            {{ csrf_field() }}

            @include('admin.quizzes.partials.form')

            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
