<?php

require "framework/core/Framework.class.php";

$pathFragments = explode('/', $_SERVER['REQUEST_URI']);	

$controller = end($pathFragments);

if ($controller === "") {
	$controller = 'IndexController';
} else {
	$controllerFile = explode('.class.php', $controller);
	$controller = $controllerFile[0];
}

$action = 'index';

Framework::run($controller,$action);

?>