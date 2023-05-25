
<?php
//include("header.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/all.css">

    <title>profile</title>
</head>
<body>
<?php 
    require("connect.php"); 
?>
    <div class="counter_profile">
        <div class="counter_img">
        <?php 
            session_start();
            $USER = $_SESSION['User'];
            $sql = "SELECT * from users where Name = :name";
            $stat = $pdo->prepare($sql);
            $stat->execute(array(
            "name" => $USER
            ));
            $R = $stat->fetch();

            $U = $R['Name'];
            $E = $R['Email'];
            $D = $R['BirthData'];
            $Img = $R['Image'];
            
            
            echo "<img src='nasem/$Img'>";
            echo "</div>";
            
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['save'])){

                    if(!empty($_POST['upname'])){
                        if(is_string($_POST['upname'])){
                            if(strlen($_POST['upname']) > 2 and strlen($_POST['upname']) < 30){
                                $upname = $_POST['upname'];
            
                            } else {
                                $Errors["eupname_length"] = "<span class='placeHolderErrors'>The name must be between 2 to 30 character</span>";
                            }
                        } else {
                            $Errors["eupname_String"] = "<span class='placeHolderErrors'>The name must be String</span>";
                        }
                    } else {
                    $Errors["eupname"] = "<span class='placeHolderErrors'>Enter your name</span>";
                    }

                    #------------------------->
                    
                    if(!empty($_POST['upemail'])){
                        $EmailS = $_POST['upemail'];
                    } else {
                        $Errors["eupemail"] = "<span class='placeHolderErrors2'>Enter your email</span>";
                    }
                    
                    #------------------------->

                    if(!empty($_FILES["img_file"]["name"])){
                        $nameImg = $_FILES["img_file"]["name"];
                        $tmpName = $_FILES["img_file"]["tmp_name"];
                        $splitName = explode(".",$nameImg);
                        $extName = strtolower(end($splitName));
                        $arrayAllow = ["png","jpg"];
                        $theName = pathinfo($nameImg,PATHINFO_FILENAME);
                        $theExt = pathinfo($nameImg,PATHINFO_EXTENSION);
                        $randNameFile =  $theName . "_" . date("mjyhis") . "." . $theExt;
                        if(in_array($extName,$arrayAllow)){
                            if($_FILES["img_file"]["size"] < 100000000){
                                move_uploaded_file($tmpName,"nasem/$randNameFile");
                            } else {
                                $Errors["eFileS_size"] = "<span class='placeHolderErrors2'>Falide size</span>";
                            }
                        } else {
                            $Errors["eFileS_type"] = "<span class='placeHolderErrors2'>Falide type</span>";
                        }
                    }

                    #---------------------->
                    if(empty($Errors)){
                    $sql = "UPDATE users SET Name=:name,Email=:email,BirthData=:BDate,Image=:img WHERE Name=:Sname";
                    $stat = $pdo->prepare($sql);
                        if(!empty($_FILES["img_file"]["name"])){
                            $img_name = $randNameFile;
                        } else {
                            $img_name = $Img;
                        }

                    $stat->execute(array(
                        "name" => $_POST["upname"],
                        "email" => $_POST["upemail"],
                        "BDate" => $_POST["updata"],
                        "img" => $img_name,
                        "Sname" => $U,
                    ));
                    session_unset();
                    session_destroy();
                    header("location:signin.php");
                }
        }
        }

            ?>

        <form class="counter_detils" method="post" enctype="multipart/form-data">
            <span class="label_input">User Name</span>
            <input type="text" value="<?php if(isset($U)) echo $U ?>" name="upname" class="profil_input">
            <?php 
            if(isset($Errors['eupname'])) echo $Errors['eupname'];
            if(isset($Errors['eupname_length'])) echo $Errors['eupname_length'];
            if(isset($Errors['eupname_String'])) echo $Errors['eupname_String'];
            ?>
            <span class="label_input">Email</span>
            <input type="Email" value="<?php if(isset($E)) echo $E ?>" name="upemail" class="profil_input">
            <?php 
            if(isset($Errors["eupemail"])) echo $Errors["eupemail"];
            ?>
            <span class="label_input">Birth Date</span>
            <input type="Date" value="<?php if(isset($D)) echo $D;?>" name="updata" class="profil_input">
            <div class="Choose_File">
            <input type="file" name="img_file" id="IM" class="Choose_File" title="Edit your image">
            <span class="iconImg">+</span>
            <?php 
            if(isset($Errors["eFileS_size"])) echo $Errors["eFileS_size"];
            if(isset($Errors["eFileS_type"])) echo $Errors["eFileS_type"];
            ?>
            </div>
            <input type="submit" value="seve" class="seve_button" name="save">
        </form>

        <a href="logout.php"><span class="logout">logout</span></a>          
    </div>

    <?php
    include("footer.php");
    ?>
</body>
</html>