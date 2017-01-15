<?php 

define(APP_PATH, 
		dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."protected".DIRECTORY_SEPARATOR);
define(UPL_PATH, 
		dirname(__FILE__).DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR);

$config = require (APP_PATH."config.php");
if(($lng=$_COOKIE["lang"])){
	$config['lang']=$lng;
}
$lang = require (APP_PATH."lang/{$config['lang']}.php");

require_once APP_PATH."controller/actions.php";
require_once APP_PATH."model/users.php";
require_once APP_PATH."/helper.php";

session_start();

$act = new Actions();

$url = $_SERVER['QUERY_STRING'];
if(in_array($_GET['lang'], ['eng','ru']) ){
	setcookie("lang",$_GET['lang'],time()+3600*24*100,'/');
	$config['lang']=$_GET['lang'];
	$tmpUrl = explode('&',$_SERVER['QUERY_STRING']);
	$tmpUrl[0] = str_replace("lang={$config['lang']}", '', $tmpUrl[0]);
	header("Location: http://".$_SERVER['HTTP_HOST'].'/'.$tmpUrl[0]);
	exit();
}

if(strpos($url,'sign-in')!==false){	
	$act->login();
}elseif(strpos($url,'sign-up')!==false){
	$act->register();
}elseif(strpos($url,'sign-out')!==false){
	$act->logout();
}elseif($url===''){
	$act->profile();
}else{
	http_response_code(404);
	$act->page404();
}

require_once APP_PATH."/view/layout.php";
