<?php
	//error_reporting(0);
	require 'lezarasok.php';
	require 'WSDLDocument/WSDLDocument.php';
	$wsdl = new WSDLDocument('Lezarasok', "http://localhost/web2/szerver/szerver.php", "http://localhost/web2/szerver/");
	$wsdl->formatOutput = true;
	$wsdlfile = $wsdl->saveXML();
	echo $wsdlfile;
	file_put_contents ("lezarasok.wsdl" , $wsdlfile);
?>
