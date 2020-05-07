<label for="">Status</label>
<select class="form-control" name="published">
    @if (isset($category->id))
        <option value="0" @if ($category->published == 0) selected="" @endif>Unpublish</option>
        <option value="1" @if ($category->published == 1) selected="" @endif>Publish</option>
    @else
        <option value="0">Unpublish</option>
        <option value="1">Publish</option>
    @endif
</select>

<label for="">Name</label>
<input type="text" class="form-control" name="title" placeholder="Title of category" value="{{$category->title ?? ''}}" required>

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Auto generate" value="{{$category->slug ?? ''}}" readonly="">

<label for="">Parent category</label>
<select class="form-control" name="parent_id">
    <option value="0">-- no patern category --</option>
    @include('admin.categories.partials.categories', ['categories' => $categories])
</select>

<hr />

<input class="btn btn-primary" type="submit" value="Save">
