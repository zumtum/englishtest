@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Edit quiz @endslot
            @slot('parent') Home @endslot
            @slot('active') Quiz @endslot
        @endcomponent

        <hr />
            {{--<script>--}}
                {{--const questions =--}}
            {{--</script>--}}
        <form class="form-horizontal" action="{{ route('admin.quiz.update', $quiz) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.quizzes.partials.form')

            <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
        </form>
    </div>
@endsection
