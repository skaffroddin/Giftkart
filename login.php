<?php

include('header.php');
require __DIR__ . '/vendor/autoload.php';
include"connection.php";


if(isset($_SESSION["user"]))
{
      echo "<script>window.open('index.php','_self')</script>";
      die();
}




if(isset($_POST['loginsubmit'])){
$user_login_query = "Select * from buyers where buyer_email = '" . $_POST['email'] . "' and  buyer_password = '" . $_POST['password'] . "'";

$user_result = $con->query($user_login_query);
$num_rows = mysqli_num_rows($user_result);

if($num_rows>0){
    $user = mysqli_fetch_array($user_result);
    $_SESSION["user"] = $user;
      echo "<script>window.open('index.php','_self')</script>";
}
else
{
     echo "<script>alert('Invalid Something')</script>";
     echo "<script>window.open('login.php','_self')</script>";
}

}

?>


                <div class="wrapper">
                    <div class="container"></div>
                    <div class="container">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-6 pannel" style="margin-top: 50px">
                            <h1>Login</h1>
                            <form method="post" action="">
                                    <div class="form-group">
                                        <!-- <label for="email">Email address <span>*</span></label> -->
                                        <input type="email"  name="email" class="form-control" id="email" placeholder="Email address" required="">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="pwd">Password <span>*</span></label> -->
                                        <input type="password" placeholder="Password" name="password" class="form-control" id="pwd" required="">
                                    </div>
                                    <button type="submit" name="loginsubmit" class="btn btn-success">LOGIN</button>
                                  
                                </form>
                                <p class="text-center">
    <a href="forgot-password.php" class="text-primary">Forgot Password?</a>
</p>

                                <hr>
                                <div class="container text-center mt-5">
        <h1>Login with Google</h1>
        <button id="google-login-btn" class="btn btn-danger btn-lg mt-3">
            <i class="fab fa-google"></i> Login with Google
        </button>
    </div>
                <!-- <a href="" class="btn btn-info btn-block">
                    Login with Facebook
                </a> -->
                        </div>
                       
                    </div>
                </div>


<?php 

include('footer.php');

?>