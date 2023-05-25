<?php

try{
  $connect="mysql:host=localhost;dbname=shop";
  $user="root";
  $pass="";


$pdo=new PDO($connect,$user,$pass);
}



catch(PDOException $e){

  $e->getMassage();
}


?>