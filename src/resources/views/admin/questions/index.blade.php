@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of questions @endslot
            @slot('parent') Home @endslot
            @slot('active') Questions @endslot
        @endcomponent
        <hr>

        <a href="{{route('admin.question.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Add new question</a>
        <table class="table table-striped">
            <thead>
            <th>Title</th>
            <th class="text-right">Action</th>
            </thead>
            <tbody>
            @forelse ($questions as $question)
                <tr>
                    <td>{{$question->title}}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Are you sure?')){return true}else{return false}" action="{{ route('admin.question.destroy', $question) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}

                            <a class="btn btn-default" href="{{route('admin.question.edit', $question)}}">Edit</a>

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
                        {{ $questions->links() }}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
