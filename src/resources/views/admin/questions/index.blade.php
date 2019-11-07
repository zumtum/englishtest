@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of questions @endslot
            @slot('parent') Home @endslot
            @slot('active') Questions @endslot
        @endcomponent
        <hr>
        @can ('create', \App\Question::class)
            <div class="form-group">
                <a href="{{route('admin.question.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Add new question</a>
            </div>
        @endcan
        <table class="table table-borderless">
            <thead class="thead-dark">
                <tr class="d-flex">
                    <th scope="col" class="col-6">Title</th>
                    <th scope="col" class="col-1">Author</th>
                    <th scope="col" class="col-1 text-center">Scores</th>
                    <th scope="col" class="col-1 text-center">Duration</th>
                    <th scope="col" class="col-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($questions as $question)
                <tr class="d-flex">
                    <td class="col-6">{{$question->title}}</td>
                    <td class="col-1">{{$question->author->name}}</td>
                    <td class="col-1 text-center">{{$question->scores}}</td>
                    <td class="col-1 text-center">{{$question->duration}} sec.</td>
                    <td class="col-3 text-right">
                        <form onsubmit="if(confirm('Are you sure?')){return true}else{return false}" action="{{ route('admin.question.destroy', $question) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            @can ('update', $question)
                                <a class="btn btn-secondary" href="{{route('admin.question.edit', $question)}}">Edit</a>
                            @endcan
                            @can ('delete', $question)
                                <button class="btn btn-danger" type="submit">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center"><h2>There're no data</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <nav>
                            <ul class="pagination justify-content-end">
                                {{$questions->links()}}
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
