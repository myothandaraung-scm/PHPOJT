<!DOCTYPE html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>

<body class="login-body">
    <div id="toolbar">
        <div id="login">
            <h3 class="text-center text-white pt-5">Login form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <!-- @if ($errors->any())
                                <HelpBlock>
                                    @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                    @endforeach
                                </HelpBlock>
                                @endif -->
                            <form action="{{ route('user.testuser') }}" class="form" method="POST">
                                @csrf
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">User Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control" onblur="validate()">
                                    @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control" onblur="validate()">
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                    <input type="submit" name="submit" id="btn-submit"class="btn btn-info btn-md" value="submit">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="#" class="text-info">Register here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
// $("input").keyup(function(){
//   alert("The text has been changed.");
// });
function validate() {
		
		var valid = true;
		valid = checkEmpty($("#name"));
		valid = valid && checkEmail($("#email"));
		
		$("#btn-submit").attr("disabled",true);
		if(valid) {
			$("#btn-submit").attr("disabled",false);
		}	
	}
	function checkEmpty(obj) {
		var name = $(obj).attr("name");
		$("."+name+"-validation").html("");	
		$(obj).css("border","");
		if($(obj).val() == "") {

			$(obj).css("border","#FF0000 1px solid");
            // if(name === 'email'){
            //     $errors = {
            //         email: 'email is required';
            //     }
            // }
            // if(name === 'password'){
            //     $errors = {
            //         passwird: 'passw is required';
            //     }
            // }
			$("."+name+"-validation").html("Required");
			return false;
		}
		
		return true;	
	}
	function checkEmail(obj) {
		var result = true;
		
		var name = $(obj).attr("name");
		$("."+name+"-validation").html("");	
		$(obj).css("border","");
		
		result = checkEmpty(obj);
		
		if(!result) {
			$(obj).css("border","#FF0000 1px solid");
			$("."+name+"-validation").html("Required");
			return false;
		}
		
		var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/;
		result = email_regex.test($(obj).val());
		
		if(!result) {
			$(obj).css("border","#FF0000 1px solid");
			$("."+name+"-validation").html("Invalid");
			return false;
		}
		
		return result;	
	}
</script>
</html>