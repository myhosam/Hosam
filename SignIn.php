
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- owl stylesheets -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
			<link rel="stylesheet" href="style_nas.css">

        <!--  stylenas signup-->
	<script src="jquery-3.1.1.min.js"></script>

 
   </head>
   <body>
<!-- header section start -->
<div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="logo" href="#"><img src="images/logo.png"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                     </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                     <div class="login_menu">
                        <ul>
                           <li><a href="signin.php">Login</a></li>
                           <li><a href="signin.php"><img src="images/user-icon.png"></a></li>
                           <li><a href="#"><img src="images/trolly-icon.png"></a></li>
                           <li> 
                           <input type="search" placeholder="search " class="input_search"></a></li>
                        </ul>
                     </div>
                  </form>
               </div>
            </nav>
         </div>
      </div>
      <!-- header section end -->


<body>


			<?php
			require_once("connect.php");
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					$sql="SELECT * from users where Name= :name and password=:pass and Active=1 ";
					$stat=$pdo->prepare($sql);
					$stat->execute(array(
						"name" => $_POST['User_Name'],
						"pass" => md5($_POST['pass']),

					));
					 
					if($stat->rowcount()){

						$row = $stat->fetch();
						$img = $row['Image'];

						if($row['Role'] == "admin"){
							setcookie("user",$_POST['User_Name'],time()+60*60*24);

							$_SESSION['User'] = $_POST['User_Name'];
							$_SESSION['role'] = "admin";
							
							header("location:cp/dashboard.php");

						}
                  else {
							setcookie("user",$_POST['User_Name'],time()+60*60*24);
							$_SESSION['User']=$_POST['User_Name'];
							$_SESSION['Email']=$row['Email'];
							$_SESSION['gen']=$row['Gender'];
							$_SESSION['date']=$row['BirthData'];
							$_SESSION['role']="user";

							header("location:index.php");
						}

					}else{
							echo "<span class='plac'>vailed user or password</span>";
					}



				}

			?>


	<div class="container" id="container">
		



		<div class="form-container sign-in-container">
			<form action="#" method="POST">
				<h1>Sign in</h1>
				<div class="social-container">
					<a href="#" class="social"><img src="images/fb-icon.png"></a>
				
					<a href="#" class="lsocia"><i class="twitter"><img src="images/twitter-icon.png"></i></a>
				</div>

				<span>or use your account</span>
				<input type="text" placeholder="User Name" name="User_Name" />
				<input type="password" placeholder="Password" name="pass" />
				<a href="#">Forgot your password?</a>
				<input type="submit" value="SignIn" class="send">
            <span>create an account? <a href="signup.php">sign up</a></span>
			</form>
		</div>






	<footer>
		<p>
			Created with <i class="fa fa-heart"></i> by
			<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
			- Read how I created this and how you can join the challenge
			<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
		</p>
	</footer>
	<script src="na.js"></script>
</body>

