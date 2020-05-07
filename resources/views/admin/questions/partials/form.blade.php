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
           value="{{ old('title', $question->title ?? '') }}" required>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea class="form-control" name="description" id="description"
              rows="10">{{ old('description', $question->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="">Slug(unique)</label>
    <input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$question->slug ?? ''}}"
           readonly="">
</div>

<div class="form-group">
    <label for="">Scores</label>
    <input type="number" class="form-control" name="scores"
           value="{{ old('scores', $question->scores ?? '') }}">
</div>

<div class="form-group">
    <label for="">Duration (seconds)</label>
    <input type="number" class="form-control" name="duration"
           value="{{ old('duration', $question->duration ?? '') }}">
</div>

<question-types
    :all-types="{{ $types }}"
    @if(isset($question->type_slug))
        :related-type="{{ json_encode($question->type_slug) }}"
    @endif
    @if(isset($answers))
        :answers="{{ $answers }}"
    @endif
>
</question-types>

<hr/>

<input class="btn btn-primary" type="submit" value="Save">
