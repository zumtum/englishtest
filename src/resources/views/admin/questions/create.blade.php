@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Add Question @endslot
            @slot('parent') Home @endslot
            @slot('active') Question @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.question.store')}}" method="post">
            {{ csrf_field() }}

            @include('admin.questions.partials.form')

            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
