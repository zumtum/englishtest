@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Invite new user @endslot
            @slot('parent') Home @endslot
            @slot('active') Invite @endslot
        @endcomponent

        <hr>
        <form action="{{route('admin.user_management.user.invite.send', $user)}}" method="get">
            {{csrf_field()}}

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email"
                       value="@if(old('email')){{old('email')}}@else{{$user->email ?? ''}}@endif" required>
            </div>
            <hr/>

            <input class="btn btn-primary" type="submit" value="Invite">
        </form>
    </div>

@endsection
