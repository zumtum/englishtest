@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of quizzes @endslot
            @slot('parent') Home @endslot
            @slot('active') Quizzes @endslot
        @endcomponent
        <hr>

        <div class="form-group">
            <a href="{{route('admin.quiz.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Add new quiz</a>
        </div>
        <table class="table table-borderless">
            <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-6">Title</th>
                    <th scope="col" class="col-1 text-center">Published</th>
                    <th scope="col" class="col-1">Duration</th>
                    <th scope="col" class="col-1 text-center">Scores</th>
                    <th scope="col" class="col-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($quizzes as $quiz)
                <tr class="d-flex">
                    <td class="col-6">{{$quiz->title}}</td>
                    <td class="col-1 text-center">
                        @if($quiz->published === 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td class="col-1">{{ \Carbon\Carbon::parse($quiz->questions->sum('duration'))->format('H:i:s') }}</td>
                    <td class="col-1 text-center">{{ $quiz->questions->sum('scores') }}</td>
                    <td class="col-3 text-right">
                        <form onsubmit="if(confirm('Are you sure?')){return true}else{return false}" action="{{ route('admin.quiz.destroy', $quiz) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            <a class="btn btn-success" href="{{route('admin.assignment.create', ['quiz_id' => $quiz])}}">Assing users</a>
                            <a class="btn btn-secondary" href="{{route('admin.quiz.edit', $quiz)}}">Edit</a>

                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>There're no data</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <nav>
                            <ul class="pagination justify-content-end">
                                {{$quizzes->links()}}
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
