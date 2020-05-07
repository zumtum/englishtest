@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Edit category @endslot
            @slot('parent') Home @endslot
            @slot('active') Categories @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.category.update', $category)}}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.categories.partials.form')
        </form>
    </div>

@endsection
