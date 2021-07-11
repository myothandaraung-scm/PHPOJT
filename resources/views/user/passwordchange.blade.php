@extends('common.layout')
@section('content')
<div class="createform">
    <div class="row">
        <h3 class="col-md-4 bg-text">Password Change</h3>
        <a class="btn btn-primary" onclick="window.location='{{ url()->previous() }}'"> Back</a>
    </div>
    <br>
    <script>console.log("erors",$errors)</script>
    <form action="{{route('user.updateuserpassword')}}" class="confirmForm" method="POST" id="myForm">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Old Password</label>
            <div class="col-sm-6">
                <input type="password" name="old_password" id="old_password" placeholder="enter old password" class="form-control" required>
                @if($errors->has('old_password'))
                    <span class="text-danger">{{ $errors->first('old_password') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-6">
                <input type="password" name="new_password" id="new_password" placeholder="enter new password" class="form-control" required>
                @if($errors->has('new_password'))
                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">New Confirm Password</label>
            <div class="col-sm-6">
                <input type="password" name="new_confirmpassword" id="new_confirmpassword" placeholder="enter new confirm password" class="form-control" required>
                @if($errors->has('new_confirmpassword'))
                    <span class="text-danger">{{ $errors->first('new_confirmpassword') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group mt-5 row">
        <button class="btn btn-primary" type="button" onclick="clearValue()">Clear</button>
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Change</button>
        </div>
    </div>
    </form>
</div>
<script>
function clearValue()
{
    $('#old_password').val("");
    $('#new_password').val("");
    $('#new_confirmpassword').val("");
}
console.log("erors",$errors)
</script>

@endsection