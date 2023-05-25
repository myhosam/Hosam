<?php
include("header.php")

?>

<head>
	  <link rel="stylesheet" href="style_nas.css">
</head>
			<?php
			require("connect.php");
				if($_SERVER["REQUEST_METHOD"] == "POST"){

						 if(isset($_POST['send'])){
							 
							 if(!empty($_POST['UserName'])){

									if(strlen($_POST['UserName']) >= 3 && strlen($_POST['UserName']) < 30){

												if(intval($_POST['UserName']==0)){
													$UserName = $_POST['UserName'];

												} else {
													$Errors['UserErrorStr'] = "<span class='ErrorsTxt'>The User Name must  be string</span>";
												}

										} else {
											$Errors['UserErrorLen'] = "<span class='ErrorsTxt'>The User Name must be above 2 character</span>";
										}

								} else {
									$Errors['UserError'] = "<span class='ErrorsTxt'>Enter User Name</span>";
								}
								

								if(!empty($_POST['Email'])){
									

									$Email = $_POST['Email'];
								} else {
									$Errors['EmailEr'] = "<span class='ErrorsTxtEmail'>Enter The Email</span>";
								}
								
								
								if(!empty($_POST['Pass'])){
									if(strlen($_POST['Pass']) > 8 && strlen($_POST['Pass']) <20){

										$pass= $_POST['Pass'];
										$password= md5($pass); 

									}else{
										$Errors['passlen'] = "<span class='ErrorsTxtpass'>The User Name must be above 2 character</span>";
									}

								
								}else{
									
									$Errors['pass'] = "<span class='ErrorsTxtpass'>Enter The passowrd</span>";


						 }

						  	if(!empty($_FILES['FileName']['name'])){
												


											$img=$_FILES['FileName']['name'];
											$temimg=$_FILES['FileName']['tmp_name'];
											$cut=explode(".",$img);
											$myTpyes=array("png","jpg");
											$WXTNAME=strtolower(end($cut));
											$name = pathinfo($img,PATHINFO_FILENAME);
											$NAMEex = pathinfo($img,PATHINFO_EXTENSION);
											$namefile = $name ."_". date("mjyhis") . "." . $NAMEex;
														if(in_array($WXTNAME,$myTpyes)){
															if($_FILES["FileName"]["size"] < 1000000000){																		if(move_uploaded_file($temimg,"nasem/$namefile")){
																			$uplode["N"]="<span class='fileErr'> file is ublode</span>";
																		}
																	}else{
																		$Errors["file_size"] ="<span class='fileErr'> file size</span>";
																	}
																}else
																{
																	$Errors["file type"] ="<span class='fileErr'> file type</span>";
																}
																	
											}else{
												$Errors["file_img"] = "<span class='fileErr'> pleas enter img </span>";
											}
								if(empty($Errors)){
									$sql = "INSERT INTO users(password,Email,Name,Gender,Image,BirthData) VALUES(:PAS,:EM,:Un,:g,:Fi,:D )";
									 $hab =$pdo->prepare($sql);
									 $hab ->bindValue(':PAS',$password);
									 $hab ->bindValue(':EM',$Email );
									 $hab ->bindValue(':Un',$UserName );
									 $hab ->bindValue(':g',$_POST['Gend'] );
									 $hab ->bindValue(':Fi',$namefile );
									 $hab ->bindValue(':D',$_POST['Date'] );
									 $hab ->execute(
										 array(
											':PAS'=>$password,
											':EM'=>$Email,
											'Un' =>$UserName,
											'g'=>$_POST['Gend'],
											':Fi'=>$namefile,
											':D'=>$_POST['Date'] 
										 )
										);
							     

								}

								}			

						 
				}



				
			?>


	<div class="container" id="container">
		<div class="form-container sign-up-container">


			<form action="#" method="POST" enctype="multipart/form-data">
				<h1>Create Account</h1>
				<div class="social-container">
				</div>
				<div class="conter_file">
					<img src="images/img50.png" alt="" class="img1">
					<input type="file" class="file_img" name="FileName"/>
					<?php
					if(isset($Errors["file_size"])) echo $Errors["file_size"];
					if(isset($Errors["file type"])) echo $Errors["file type"];
					if(isset($Errors["file_img"])) echo $Errors["file_img"];
					if(isset($uplode["N"])) echo $uplode["N"];
				
					?>
					
				
				</div>
				<input type="text" placeholder=" Name" name="UserName"/>
				<?php
				 if(isset($Errors['UserError'])) echo $Errors['UserError'];
				 if(isset($Errors['UserErrorLen'])) echo $Errors['UserErrorLen'];
				 if(isset($Errors['UserErrorStr'])) echo $Errors['UserErrorStr'];
				 ?>

				<input type="email" placeholder="Email" name="Email"/>
				<?php 
				if(isset($Errors['EmailEr'])) echo $Errors['EmailEr'];
				?>
				
				<input type="password" placeholder="Password" name="Pass"/>
				<?php 
				if(isset($Errors['pass'])) echo $Errors['pass'];
				if(isset($Errors['passlen'])) echo $Errors['passlen'];
				?>
				<input type="date" value="2003-10-02" name="Date"/>
<div class="gender">
	<label for="gen1">male</label>
	<input type="radio" name="Gend" id="gen1" checked value="male">

	<label for="gen2">Fmale</label>
	<input type="radio" name="Gend" id="gen2"  value="fmale">

</div>

				<input type="submit" value="Sign Up" class="send" name="send">
				<span>you have an account? <a href="signin.php">sign in</a></span>
		
			</form>


		</div>


	

		


</body>


