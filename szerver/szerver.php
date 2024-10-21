<?php
	require("lezarasok.php");
	$server = new SoapServer("lezarasok.wsdl");
	$server->setClass('Lezarasok');
	$server->handle();
?>
