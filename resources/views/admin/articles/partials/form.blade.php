<label for="">Status</label>
<select class="form-control" name="published">
    @if (isset($article->id))
        <option value="0" @if ($article->published == 0) selected="" @endif>Unpublish</option>
        <option value="1" @if ($article->published == 1) selected="" @endif>Publish</option>
    @else
        <option value="0">Unpublish</option>
        <option value="1">Publish</option>
    @endif
</select>

<label for="">Title</label>
<input type="text" class="form-control" name="title" placeholder="Title of news" value="{{$article->title ?? ''}}" required>

<label for="">Slug(unique)</label>
<input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$article->slug ?? ''}}" readonly="">

<label for="">Parent category</label>
<select class="form-control" name="categories[]" multiple="">
    <option value="0">-- no patern category --</option>
    @include('admin.articles.partials.categories', ['categories' => $categories])
</select>

<label for="">Short description</label>
<textarea class="form-control" name="description_short" id="description_short">{{ $article->description_short ?? '' }}</textarea>

<label for="">Description</label>
<textarea class="form-control" name="description" id="description">{{ $article->description ?? '' }}</textarea>

<hr />

<input class="btn btn-primary" type="submit" value="Save">
