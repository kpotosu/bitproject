<?php
session_start();
require_once'./Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_loader_Filesystem('./temp');
$twig=new Twig_Environment($loader);

$template=$twig->loadTemplate('indexextension.tpl');

$param = array('about'=>'About us',
);

$template->display($param);

?>