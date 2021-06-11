@extends('common.layout')
@section('content')
    <div class="container">
        <div class="col-md-8 justify-content-center">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form name="my_form" method="">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-left">Full Name</label>
                            <div class="col-md-6 input-group-prepend">
                              <input type="text" id="name" class="form-control" name="name" ><span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">Email Address</label>
                            <div class="col-md-6 input-group-prepend">
                                <input type="text" id="email" class="form-control" name="email"><span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">Password</label>
                            <div class="col-md-6 input-group-prepend">
                                <input type="password" id="user_name" class="form-control" name="username"><span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-left">Confirm  Password</label>
                            <div class="col-md-6 input-group-prepend">
                                <input type="password" id="confirm_password" class="form-control"><span class="fillData">*</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-left">Type</label>
                            <div class="col-md-6  input-group-prepend">
                                <select class="" name="type">
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
                                <input type="text" id="phone" class="form-control" name="phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Date of Birth</label>
                            <div class="col-md-6">
                                <input type="date" id="dob" class="form-control" name="dob">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Address</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" id="address" style="height:50px" name="description" placeholder="address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-left">Profile</label>
                            <div class="col-md-6">
                                <input type="file" name="image" id="image" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <img id="preview-image-before-upload" alt="preview image" style="width: 120px;height: 100px;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="submit">Create</button>
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