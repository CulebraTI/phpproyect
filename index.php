<?php
require_once 'Zend/Loader.php'; // the Zend dir must be in your include_path
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$yt = new Zend_Gdata_YouTube();


require "db/db.php";
require 'vendor/autoload.php';
require "controladores/ctrl_index.php";
require_once('clases/Singleton.php');
require_once('clases/template.php');
$controlIndex=new ControladorIndex();




$tpl = Template::getInstance();
$tpl->asignar('url_base',"http://localhost/claseMod/clase5/");
$tpl->asignar('url_logout',$controlIndex->getUrl("usuario","logout"));

//Cargamos controladores y acciones






if(isset($_GET['url'])){
	$query = $_GET['url'];
	$request = explode('/', $query);
	$controller = (!empty($request[0])) ? $request[0] : 'usuario';
	$action = (!empty($request[1])) ? $request[1] : 'listado';
	$params=array();
	for ($i=2; $i <count($request) ; $i++) { 
		$params[]=$request[$i];
	}
}else{
	$controller="usuario";
	$action="listado";
	$params=array();
}

$controllerObj=$controlIndex->cargarControlador($controller);
$controlIndex->ejecutarAccion($controllerObj,$action,$params);

?>
