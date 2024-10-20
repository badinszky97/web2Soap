<?php
	require("mobilok.php");
	$server = new SoapServer("mobilok.wsdl");
	$server->setClass('Mobilok');
	$server->handle();
?>
