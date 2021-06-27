@extends('common.layout')
@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form action="{{route('user.confirmuser')}}" method="POST" name="my_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-left">Full Name</label>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name" value="{{$user->name}}"  required><span class="fillData">*</span> <br/>
                                </div>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>      
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">Email Address</label>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <input type="text" id="email" class="form-control" name="email" placeholder="Enter Email"value="{{$user->email}}" required><span class="fillData">*</span>
                                </div>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">Password</label>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <input type="password"  class="form-control" name="password" id="password" placeholder="Enter Password" value="{{$user->password}}" required><span class="fillData">*</span>
                                </div>
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div> 
                                
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-left">Confirm  Password</label>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" value="{{$user->confirm_password}}" required><span class="fillData">*</span><br/>
                                </div>
                                @if($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>                               
                            
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-left">Type</label>
                            <div class="col-md-6  input-group-prepend">
                                <select class="form-control" name="type" id="type" required>
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
                                <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Phone" value="{{$user->phone}}">
                                @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Date of Birth</label>
                            <div class="col-md-6">
                                <input type="date" id="dob" class="form-control" name="dob" placeholder="Enter Date Of Birth" value="{{$user->dob}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Address</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="address" style="height:50px" name="address" placeholder="address" value="{{$user->address}}" ></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Profile</label>
                            <div class="col-md-6 input-group-prepend">
                                <input type="file" name="profile" id="image" value="{{$user->profile}}" required>
                                <span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <img id="preview" alt="preview image" style="width: 120px;height: 100px;">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-md-4"></div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary" type="button" onclick="clearValue()">Clear</button>
                                <button  type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                       </div>                                                    
                    </form>                       
                </div>                                  
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function clearValue()
            {
                $('#name').val("");
                $('#email').val("");
                $('#password').val("");
                $('#confirm_password').val("");
                $('#phone').val("");
                $('#address').val("");
                $('#image').val("");
                $('#type').val("");
                $("#preview").removeAttr("src");

            }
      
      $(document).ready(function (e) {
       
         
         $('#image').change(function(){
                  
          let reader = new FileReader();
       
          reader.onload = (e) => { 
       
            $('#preview').attr('src', e.target.result); 
          }
       
          reader.readAsDataURL(this.files[0]); 
         
         });
         
      });
       
      </script>
@endsection