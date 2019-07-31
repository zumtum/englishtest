@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        {{--@component('admin.components.breadcrumb')--}}
            {{--@slot('title') Список категорий @endslot--}}
            {{--@slot('parent') Главная @endslot--}}
            {{--@slot('active') Категории @endslot--}}
        {{--@endcomponent--}}

        <hr>

        <a href="{{route('admin.user_management.user.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Add new user</a>
        <table class="table table-striped">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Delete?')){return true}else{return false}" action="{{route('admin.user_management.user.destroy', $user)}}" method="post">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}

                            <a href="{{route('admin.user_management.user.edit', $user)}}" class="btn btn-default">Edit</a>

                            <button type="submit" class="btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>No data</h2></td>
                </tr>
            @endforelse
            </tbody>
            <ttfoot>
                <tr>
                    <td colspan="3">
                        <ul class="pagination pull-right">
                            {{$users->links()}}
                        </ul>
                    </td>
                </tr>
            </ttfoot>
        </table>
    </div>

@endsection
