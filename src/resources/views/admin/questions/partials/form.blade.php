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
    <label for="">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title of question"
           value="@if(old('title')){{old('title')}}@else{{$question->title ?? ''}}@endif" required>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea class="form-control" name="description" id="description"
              rows="10">@if(old('description')){{old('description')}}@else{{ $question->description ?? '' }}@endif</textarea>
</div>

<div class="form-group">
    <label for="">Slug(unique)</label>
    <input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$question->slug ?? ''}}"
           readonly="">
</div>

<div class="form-group">
    <label for="">Scores</label>
    <input type="number" class="form-control" name="scores"
           value="@if(old('scores')){{old('scores')}}@else{{$question->scores ?? ''}}@endif">
</div>

<div class="form-group">
    <label for="">Duration (seconds)</label>
    <input type="number" class="form-control" name="duration"
           value="@if(old('duration')){{old('duration')}}@else{{$question->duration ?? ''}}@endif">
</div>
{{--<div class="form-group">--}}
{{--<label for="">Question type</label>--}}
{{--<select class="form-control" name="type_slug">--}}
{{--@if (isset($question->id))--}}
{{--@foreach($types as $type)--}}
{{--<option value="{{ $type->slug }}" @if ($question->type_slug == $type->slug) selected="" @endif>{{ $type->name }}</option>--}}
{{--@endforeach--}}
{{--@else--}}
{{--@foreach($types as $type)--}}
{{--<option value="{{ $type->slug }}" @if (old('type_slug') == $type->slug) selected="" @endif>{{ $type->name }}</option>--}}
{{--@endforeach--}}
{{--@endif--}}
{{--</select>--}}
{{--</div>--}}
<question-types :types="{{ $types }}"></question-types>

<hr/>

<input class="btn btn-primary" type="submit" value="Save">
