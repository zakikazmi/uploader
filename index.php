<?php
session_start();
require_once("user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('user_portal.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->Login($uname,$umail,$upass))
	{
		$login->redirect('user_portal.php');
	}
	else
	{
		$error = "Login is Incorrect!";
	}	
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>SUS Home</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body class="body-background">
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand"><img src="images/sus_logo.png"></a>
        </div>
      </div>
    </nav>
<div class="signin-form">

	<div class="container">
     <div class="col-lg-6">
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign In</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
      	<br />
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
      </form>
    </div>
     <div class="col-lg-6">
         <div class="form-signin">
             <img src="images/sus_big.png">
         <p class="box-color">Secure, anonymous, free. It's the simplest way to save your documents Online</p>
        
             <ul
         </div>

    </div>
    </div>
    
</div>

</body>
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright © Secure Upload Software
                    </div>
                </div>
            </div>
        </div>
    </footer>
</html>