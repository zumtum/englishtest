@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Add assignment @endslot
            @slot('parent') Home @endslot
            @slot('active') Assignment @endslot
        @endcomponent

        <hr />
        <form class="form-horizontal" action="{{route('admin.assignment.store')}}" method="post">
            {{ csrf_field() }}

            @include('admin.assignments.partials.form')

            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
