@extends('common.layout')
@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center">
            <div class="card">
                <div class="card-header">Edit User Information</div>
                <div class="card-body">
                    <form action="{{route('user.confirmedituser')}}" method="POST" name="my_form" enctype="multipart/form-data">
                        @csrf 

                        <div class="form-group row">   
                            <div class="col-md-4 col-form-label text-md-left"><h3>Edit User</h3></div>
                            <div class="col-md-6 text-right">
                                <img src="{{url($user->profile)}}"  alt="profile-image" style="width: 120px;height: 100px;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-left">Full Name</label>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}" required><span class="fillData">*</span> <br/>
                                </div>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <input type="text" name="id" hidden class="form-control-plaintext" value="{{$user->id}}">
      
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">Email Address</label>
                            <div class="col-md-6">
                                <input type="text" name="email" readonly class="form-control-plaintext" value="{{$user->email}}">
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-left">Type</label>
                            <div class="col-md-6  input-group-prepend">
                                <select class="form-control" name="type" required>
                                    <option value="">Select  type</option>
                                    <option value="0">Admin</option>
                                    <option value="1">User</option>
                                </select>
                                <span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">Phone</label>
                            <div class="col-md-6">
                                <input type="text" id="phone" class="form-control" name="phone" value="{{$user->phone}}">
                                @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Date of Birth</label>
                            <div class="col-md-6">
                                <input type="date" id="dob" class="form-control" name="dob" value="{{$user->dob}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Address</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="address" style="height:50px" name="address" placeholder="address" >{{$user->address}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Profile</label>
                            <div class="col-md-6 input-group-prepend">
                                <input type="file" name="profile" id="image"required>
                                <span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <img id="preview-image-before-upload" alt="preview image" style="width: 120px;height: 100px;">
                            </div>
                        </div>
                        <a href="{{route('user.changeuserpassword')}}">Change password</a>
                        <div class="form-group mt-5 row">
                            <div class="col-md-3"></div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}'">Cancel</button>
                                <button  type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>

                                                    
                    </form>                       
                </div>                   
                
            </div>
        </div>
    </div>
    <script type="text/javascript">
      
      $(document).ready(function (e) {
       
         
         $('#image').change(function(){
                  
          let reader = new FileReader();
       
          reader.onload = (e) => { 
       
            $('#preview-image-before-upload').attr('src', e.target.result); 
          }
       
          reader.readAsDataURL(this.files[0]); 
         
         });
         
      });
       
      </script>
@endsection