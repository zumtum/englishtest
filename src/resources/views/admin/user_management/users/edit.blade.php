@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        {{--@component('admin.components.breadcrumb')--}}
        {{--@slot('title') Список категорий @endslot--}}
        {{--@slot('parent') Главная @endslot--}}
        {{--@slot('active') Категории @endslot--}}
        {{--@endcomponent--}}

        <h2>User edit</h2>

        <hr>
        <form class="form-horzontal" action="{{route('admin.user_management.user.update', $user)}}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.user_management.users.partials.form')
        </form>
    </div>

@endsection
