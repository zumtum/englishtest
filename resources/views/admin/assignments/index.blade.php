@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of assigments @endslot
            @slot('parent') Home @endslot
            @slot('active') Users control @endslot
        @endcomponent

        <hr>

        @can ('create', \App\Assignment::class)
            <div class="form-group">
                <a href="{{route('admin.assignment.create')}}" class="btn btn-primary pull-right"><i
                            class="fa fa-plus-square-o"></i> Add new assigment</a>
            </div>
        @endcan
        <table class="table  table-borderless">
            <thead class="thead-dark">
            <tr class="d-flex">
                <th scope="col" class="col-3">Quiz Title</th>
                <th scope="col" class="col-2">Quiz Author</th>
                <th scope="col" class="col-3">Emails</th>
                <th scope="col" class="col-1">Status</th>
                <th scope="col" class="col-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($assignments as $assignment)
                <tr class="d-flex">
                    <td class="col-3">{{ $assignment->quiz->title }}</td>
                    <td class="col-2">{{ $assignment->quiz->author->name }}</td>
                    <td class="col-3">{{ $assignment->users->pluck('email')->implode(', ') }}</td>

                    <td class="col-1">@if ($assignment->sended === 1) Sended @else Not sended @endif</td>
                    <td class="col-3 text-right">
                        <form onsubmit="if(confirm('Delete?')){return true}else{return false}"
                              action="{{route('admin.assignment.destroy', $assignment)}}" method="post">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}

                            @can ('send', $assignment)
                                <a href="{{route('admin.assignment.send', $assignment)}}"
                                   class="btn btn-success">@if ($assignment->sended === 1) Resend @else Send @endif</a>
                            @endcan
                            @can ('update', $assignment)
                                <a href="{{route('admin.assignment.edit', $assignment)}}"
                                   class="btn btn-secondary">Edit</a>
                            @endcan

                            @can ('delete', $assignment)
                                <button type="submit" class="btn btn-danger">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center"><h2>No assignments</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <nav>
                            <ul class="pagination justify-content-end">
                                {{$assignments->links()}}
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
