<?php
   session_start();
?>

<?php
    include('../connection.php');
    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $query = "SELECT teacher_email FROM teachers WHERE teacher_email='$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0){
            // $_SESSION['email'] = $email;
            $_SESSION['teacher_email'] = $email;
            $_SESSION['teacher_login_status'] = "logged in";
            // echo    $_SESSION['teacher_email'];
            header("location:./dashboard.php");
        }else{
            echo "<p style='color: red;'>Incorrect email or password</p>";
        }
    }
    
?>




<!doctype html>
<html lang="en">
  <head>
  	<title>Seisdl</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
	
	<link rel="stylesheet" href="../css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Teacher</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(../images/4957136.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								
			      	</div>
							<form action="" method="post" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="email">Email</label>
			      			<input type="email" class="form-control" placeholder="Email" name="email" id="email" required/>
							  <p id="emailcheck"></p>
			      		</div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-info rounded submit px-3" name="login">Sign In</button>
		            </div>
		           </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="./login.js"></script> -->
	<script type="text/javascript">
        $(document).ready(function () {
            $('#emailcheck').hide();
            $('#passcheck').hide();
            var email_err = true;
            var pass_err = true;
            $('#email').keyup(function () {
                email_check();
            })
            function email_check() {
			
                var emailstr = $('#email').val(); 
                if (emailstr.length == '') {
                    $('#emailcheck').show();
                    $('#emailcheck').html("**Please Fill the field");
                    $('#emailcheck').focus();
                    $('#emailcheck').css("color", "red");
                    email_err = false;
                    return false;
                }
                else {
                    $('#emailcheck').hide();
                }
                if ((emailstr.indexOf("@") < 0) || (emailstr.indexOf(".") < 0)) {
                    $('#emailcheck').show();
                    $('#emailcheck').html("**Email must contain @ and dot(.)");
                    $('#emailcheck').focus();
                    $('#emailcheck').css("color", "red");
                    email_err = false;
                    return false;
                }

                else {
                    $('#emailcheck').hide();
                }
            }

               $('#submitbtn').click(function(){
                   email_err = true;
                   pass_err=true;
                   email_check();
                   password_check();
                   if((email_err==true)&&(pass_err==true)){
                        return true;
                   }
                   else{
                       return false;
                   }
               })
        })
    </script>
	</body>
</html>