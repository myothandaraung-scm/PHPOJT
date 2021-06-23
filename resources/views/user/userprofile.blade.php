@extends('common.layout')
@section('content')
<form class="confirmForm">
    @method('PUT')
    @csrf
    <div class="form-group">   
        <div class="text-left"><h3>User Profile</h3></div>
        <div class="text-center">
            <a href="{{route('user.edituser',$user->id)}}">Edit</a>
        </div>
    </div>
    <div class="form-group row">
        
        <div class="col-md-8 col-sm-8 text-center">
            
            <input type="text" name="profile" hidden class="form-control-plaintext" value="{{$user->profile}}">
            
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" readonly class="form-control-plaintext" value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" readonly class="form-control-plaintext" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Type</label>
                <div class="col-sm-6">
                    <input type="text" name="type" readonly class="form-control-plaintext" value="{{$user->typeString}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" readonly class="form-control-plaintext" value="{{$user->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Date of Birth</label>
                <div class="col-sm-6">
                    <input type="text" name="dob" readonly class="form-control-plaintext" value="{{$user->dob}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" readonly class="form-control-plaintext" value="{{$user->address}}">
                </div>
            </div>                 
        </div>
        <div class="col-md-2 col-sm-2">          
            <img src="{{url($user->profile)}}"  alt="profile-image" style="width: 120px;height: 100px;">           
        </div>
        
    </div>
    
</form>

@endsection