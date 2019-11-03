@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Edit assignment @endslot
            @slot('parent') Home @endslot
            @slot('active') Assignment @endslot
        @endcomponent

        <hr>
        <form class="form-horizontal" action="{{route('admin.assignment.update', $assignment)}}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.assignments.partials.form')

            <input type="hidden" name="updated_at" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
