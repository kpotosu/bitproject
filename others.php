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
$str_query="SELECT DISTINCT project_id,name,description,target,prodate,public_key FROM project ORDER BY name";
$data=mysqli_query($mysqli,$str_query);

if($data){
	$mydataset=array();
	while($row=mysqli_fetch_assoc($data)){
		$mydataset[]=array('projectName'=>$row['name'],'projectDes'=>$row['description'],'protarget'=>$row['target'],'projdate'=>$row['prodate'],'prokey'=>$row['public_key']);
	}
}
$template=$twig->loadTemplate('others.html');
$param = array('others'=>$mydataset);
$template->display($param);

?>