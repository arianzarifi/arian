<?php
session_start() ;
include("config.php") ;
$config = new config() ;
if(isset($_GET["page"]))
{
	$page = $_GET["page"] ;
}
else 
{
	$page = null ;
}
if($page==null)
{
	$ModelFile = "model/model.php" ;
	$ControllerFile = "controller/controller.php" ;
}
else
{
	$ModelFile = "model/$page.model.php" ;
	$ControllerFile = "controller/$page.controller.php" ;
}
include($ModelFile) ;
include($ControllerFile) ;
include("view/view.php") ;

$m = ucwords($page)."Model" ;
$c = ucwords($page)."controller" ;

$model = new $m($config) ;
$controller = new $c($model) ;
$view = new view($controller , $model) ;
if(isset($_GET["action"]))
{
	$controller->{$_GET["action"]}() ;
}

$view->output($page) ;



?>