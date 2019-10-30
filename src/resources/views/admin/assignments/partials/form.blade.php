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
    <label for="">Quizzes</label>
    <select class="form-control" name="quiz_id">
        @foreach($quizzes as $quiz)
            <option value="{{ $quiz->id }}">{{ $quiz->title }} ({{ $quiz->slug}})</option>
        @endforeach
    </select>
</div>
<emails-select></emails-select>
{{--<questions-select--}}
        {{--:questions="{{ $questions }}"--}}
        {{--@if (isset($relatedQuestions))--}}
        {{--:related-questions="{{ $relatedQuestions }}"--}}
        {{--@endif--}}
        {{--:user-id="{{ $userId }}">--}}
{{--</questions-select>--}}
<hr/>
<input class="btn btn-primary" type="submit" value="Save">