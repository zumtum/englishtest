<label for="">Status</label>
<select class="form-control" name="published">
    @if (isset($quiz->id))
        <option value="0" @if ($quiz->published == 0) selected="" @endif>Unpublish</option>
        <option value="1" @if ($quiz->published == 1) selected="" @endif>Publish</option>
    @else
        <option value="0">Unpublish</option>
        <option value="1">Publish</option>
    @endif
</select>

<label for="">Title</label>
<input type="text" class="form-control" name="title" placeholder="Title of quiz" value="{{$quiz->title ?? ''}}" required>

<label for="">Slug(unique)</label>
<input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$quiz->slug ?? ''}}" readonly="">

<label for="">Short description</label>
<textarea class="form-control" name="description_short" id="description_short">{{ $quiz->description_short ?? '' }}</textarea>

<hr />

<input class="btn btn-primary" type="submit" value="Save">
