@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of quizzes @endslot
            @slot('parent') Home @endslot
            @slot('active') Quizzes @endslot
        @endcomponent
        <hr>

        <a href="{{route('admin.quiz.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Add new quiz</a>
        <table class="table table-striped">
            <thead>
            <th>Title</th>
            <th>Publish</th>
            <th class="text-right">Action</th>
            </thead>
            <tbody>
            @forelse ($quizzes as $quiz)
                <tr>
                    <td>{{$quiz->title}}</td>
                    <td>{{$quiz->published}}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Are you sure?')){return true}else{return false}" action="{{ route('admin.quiz.destroy', $quiz) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            <a class="btn btn-default" href="{{route('admin.quiz.edit', $quiz)}}">Edit</a>

                            <button class="btn" type="submit">Delete</button>
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
                <td collspan="3">
                    <ul class="pagenation pull-right">
                        {{ $quizzes->links() }}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
