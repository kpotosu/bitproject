<?php
require_once'./Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_loader_Filesystem('./temp');
$twig=new Twig_Environment($loader);

define('DB_HOST', 'localhost');
define("DB_NAME", 'bitimpact');
define("DB_PORT", 3306);
define("DB_USER", "root");
define("DB_PWORD", "");

$mysqli= mysqli_connect(DB_HOST,DB_USER,DB_PWORD,DB_NAME);
if(mysqli_connect_errno()){
  print("Connection failed: %s\n".
    mysqli_connect_errors());
  exit();
}

if($_POST['projectName']=="" || $_POST['description']=="" || $_POST['target']=="" || $_POST['proKey']==""){

  $param = array('error'=>'Kindly fill all the fields');
 $template=$twig->loadTemplate('createproject.html');
 $template->display($param);
}
else{

$projectName=$_POST['projectName'];
$projectDesc=$_POST['description'];
$projectTarget=$_POST['target'];
$projectKey=$_POST['proKey'];


$str_query="INSERT INTO project (name,description,target,public_key) VALUES ('$projectName','$projectDesc','$projectTarget','$projectKey')";
$data=mysqli_query($mysqli,$str_query);

if($data){

  $param = array('project'=>'Project successfully created');

}else{
  $param = array('error'=>'Project not created');
 
}
 $template=$twig->loadTemplate('createproject.html');
 $template->display($param);
}

  ?>