
<?php

// Start the session
session_start();

if(isset($_SESSION["user"]))
{
      echo "<script>window.open('index.php','_self')</script>";
      die();
}


$error = "";

if(isset($_POST['loginsubmit'])){

if($_POST['email'] == 'admin@gmail.com' && $_POST['password'] = 'admin'){
      $_SESSION["user"] = 'admin@gmail.com';
      echo "<script>window.open('index.php','_self')</script>";
}
else
{
    $error= "Invalid Login Detais";
}

}
?>

<html>
<head>
<title>Admin</title>
<meta charset="UTF-8" />

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

</head>

<body style="background-color: #f4f5fb;margin-top: 80px">
<div class="container">
    <div class="row">
    	<div class="col-md-3">
    		
    	</div>
    	<div class="col-md-6 panel" style="margin-top: 50px">
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
                        </div>
	
	</div>
</div>


<span> <?php echo $error; ?>

</body>
</html>