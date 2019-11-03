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
            <option
                    value="@if(old('quiz_id')){{old('quiz_id')}}@else{{$quiz->id ?? ''}}@endif"
                    @if (isset($assignment->quiz_id) && $assignment->quiz_id == $quiz->id) selected="" @endif
                    @if (isset($assignedQuiz) && $assignedQuiz->id == $quiz->id) selected="" @endif>
                {{ $quiz->title }} ({{ $quiz->slug }})
            </option>
        @endforeach
    </select>
</div>
<emails-select
        :users="{{ $users }}"
        @if(isset($relatedUsers))
        :related-users="{{ $relatedUsers }}"
        @endif
></emails-select>
<div class="form-check mt-3">
    <input type="checkbox" class="form-check-input" id="send" name="send" checked="">
    <label class="form-check-label" for="send">Send email when assignment is saved</label>
</div>
<hr/>
<input class="btn btn-primary" type="submit" value="Save">