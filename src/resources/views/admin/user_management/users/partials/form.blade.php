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
    <label for="">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email"
           value="{{ old('email', $user->email ?? '') }}" required>
</div>
<div class="form-group">
    <label for="">Password</label>
    <input type="password" class="form-control" name="password">
</div>
<div class="form-group">
    <label for="">Confirm password</label>
    <input type="password" class="form-control" name="password_confirmation">
</div>
<hr/>

<input class="btn btn-primary" type="submit" value="Save">
