<?php 

include "lib/config.php";
include "lib/Database.php"; 
include "lib/Session.php";    

Session::checkLogin();


spl_autoload_register(function($class){

         include_once "classes/".$class.".php";
});

	
	


?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
	<style>
	.warning{font-size:18px;color:red;font-style:italic;font-family: 'Times New Roman';}
    .success{font-size:18px;color:green;font-style:italic;font-family: 'Times New Roman';}
	</style>
</head>
<body>
<div class="container">

	<section id="content">
	<?php
				 
				 $Admin= new admin();

				 if ($_SERVER['REQUEST_METHOD']=="POST" &&  isset($_POST['submit'])  ) {
						
						$adminDataSending=$Admin->adminLogin($_POST);
				 
						if ($adminDataSending) {
						   
							 return $adminDataSending;
						}
				 
				 }
			 
			 ?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			
			<div>
				<input type="text" placeholder="your valid Email" name="logInEmail" />
			</div>
			<div>
				<input type="password" placeholder="Password"  name="logInPassword" />
			</div>
			<div>
				<input type="submit" name="submit" value="Log In" />
			</div>
		</form><!-- form -->
		<div class="button">
		<button style="width:250px;height:40px;background:#fc7;border-radius:5px;" ><a href="Forgotpassword.php">Forgoten password!!</a></button> 
       </br>
			<a href="#">stay with shibbir-it institute</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>