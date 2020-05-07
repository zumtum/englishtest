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
</div>

<div class="form-group">
    <label for="">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title of quiz"
           value="{{ old('title', $quiz->title ?? '') }}" required>
</div>

<div class="form-group">
    <label for="">Slug(unique)</label>
    <input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$quiz->slug ?? ''}}"
           readonly="">
</div>

<div class="form-group">
    <label for="">Short description</label>
    <textarea class="form-control" name="description_short"
              id="description_short">{{ old('description_short', $quiz->description_short ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="">Quiz type</label>
    <select class="form-control" name="type_slug">
        @if (isset($quiz->id))
            @foreach($types as $type)
                <option value="{{ $type->slug }}"
                        @if ($quiz->type_slug == $type->slug) selected="" @endif>{{ $type->name }}</option>
            @endforeach
        @else
            @foreach($types as $type)
                <option value="{{ $type->slug }}"
                        @if (old('type_slug') == $type->slug) selected="" @endif>{{ $type->name }}</option>
            @endforeach
        @endif
    </select>
</div>

<questions-select
        :questions="{{ $questions }}"
        @if (isset($relatedQuestions))
        :related-questions="{{ $relatedQuestions }}"
        @endif
        :user-id="{{ $userId }}">
</questions-select>
<hr/>
<input class="btn btn-primary" type="submit" value="Save">