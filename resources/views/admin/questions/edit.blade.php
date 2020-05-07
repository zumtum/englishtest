@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Edit question @endslot
            @slot('parent') Home @endslot
            @slot('active') Question @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{ route('admin.question.update', $question) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.questions.partials.form')

            <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
