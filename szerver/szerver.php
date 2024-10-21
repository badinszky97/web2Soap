<?php
	require("mobilok.php");
	$server = new SoapServer("mobilok.wsdl");
	$server->setClass('Lezarasok');
	$server->handle();
?>
