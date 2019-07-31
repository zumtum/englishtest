@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Edit news @endslot
            @slot('parent') Home @endslot
            @slot('active') News @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{ route('admin.article.update', $article) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.articles.partials.form')

            <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
        </form>
    </div>

@endsection
