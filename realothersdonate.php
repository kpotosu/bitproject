<?php
require_once'./Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_loader_Filesystem('./temp');
$twig=new Twig_Environment($loader);

  $template=$twig->loadTemplate('realothersdonate.html');
  $param = array('error'=>'');

  $template->display($param);

  ?>