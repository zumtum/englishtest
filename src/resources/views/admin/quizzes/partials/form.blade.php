@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<label for="">Status</label>
<select class="form-control" name="published">
    @if (isset($quiz->id))
        <option value="1" @if ($quiz->published == 1) selected="" @endif>Publish</option>
        <option value="0" @if ($quiz->published == 0) selected="" @endif>Unpublish</option>
    @else
        <option value="1" @if (old('published') == 1) selected="" @endif>Publish</option>
        <option value="0" @if (old('published') == 0) selected="" @endif>Unpublish</option>
    @endif
</select>

<label for="">Title</label>
<input type="text" class="form-control" name="title" placeholder="Title of quiz" value="@if(old('title')){{old('title')}}@else{{$quiz->title ?? ''}}@endif" required>

<label for="">Slug(unique)</label>
<input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$quiz->slug ?? ''}}" readonly="">

<label for="">Short description</label>
<textarea class="form-control" name="description_short" id="description_short">@if(old('description_short')){{old('description_short')}}@else{{ $quiz->description_short ?? '' }}@endif</textarea>

<label for="">Duration (minutes)</label>
<input type="number" class="form-control" name="duration" value="@if(old('duration')){{old('duration')}}@else{{$quiz->duration ?? ''}}@endif">

<label for="">Quiz type</label>
<select class="form-control" name="type_slug">
    @if (isset($quiz->id))
        @foreach($types as $type)
            <option value="{{ $type->slug }}" @if ($quiz->type_slug == $type->slug) selected="" @endif>{{ $type->name }}</option>
        @endforeach
    @else
        @foreach($types as $type)
            <option value="{{ $type->slug }}" @if (old('type_slug') == $type->slug) selected="" @endif>{{ $type->name }}</option>
        @endforeach
    @endif
</select>

<label for="">Questions</label>
{{--<div id="questions-app">--}}
    <questions-select
            :questions="{{ $questions }}"
            @if (isset($relatedQuestions))
                :related-questions="{{ $relatedQuestions }}"
            @endif
            :user-id="{{ $userId }}">
    </questions-select>
{{--</div>--}}

<hr />

<input class="btn btn-primary" type="submit" value="Save">

{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
