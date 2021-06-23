@extends('common.layout')
@section('content')
<form action="{{route('user.updateuser')}}" class="confirmForm" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">   
        <div class="text-left"><h3>Edit User Confrimation</h3></div>
        <div class="text-right">
            <img src="{{url($user->profile)}}" alt="profile-image" style="width: 120px;height: 100px;">
        </div>
    </div>
    <input type="text" name="profile" hidden class="form-control-plaintext" value="{{$user->profile}}">

    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" readonly class="form-control-plaintext" value="{{$user->name}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" name="email" readonly class="form-control-plaintext" value="{{$user->email}}">
        </div>
        <input type="text" name="id" hidden class="form-control-plaintext" value="{{$user->id}}">

    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-6">
            <input type="text" name="type" readonly class="form-control-plaintext" value="{{$user->type}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-6">
            <input type="text" name="phone" readonly class="form-control-plaintext" value="{{$user->phone}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Date of Birth</label>
        <div class="col-sm-6">
            <input type="text" name="dob" readonly class="form-control-plaintext" value="{{$user->dob}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" name="address" readonly class="form-control-plaintext" value="{{$user->address}}">
        </div>
    </div>

    <div class="justify-content-center">
        <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}'">Cancel</button>
        <button class="btn btn-primary " type="submit">Update</button>
    </div>
</form>

@endsection