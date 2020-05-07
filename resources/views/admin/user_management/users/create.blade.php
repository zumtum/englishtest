@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        {{--@component('admin.components.breadcrumb')--}}
        {{--@slot('title') Список категорий @endslot--}}
        {{--@slot('parent') Главная @endslot--}}
        {{--@slot('active') Категории @endslot--}}
        {{--@endcomponent--}}

        <hr>
        <form action="{{route('admin.user_management.user.store', $user)}}" method="post">
            {{csrf_field()}}

            @include('admin.user_management.users.partials.form')
        </form>
    </div>

@endsection
