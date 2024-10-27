<?php
include('./includes/config.inc.php');

$dbh = new PDO('mysql:host=localhost;dbname=forgalomSOAP','root', '',
array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
$sql = "select * from menu where url=\"/\"";
$sth = $dbh->prepare($sql);
$sth->execute(array());
$keres = $sth->fetchAll(PDO::FETCH_ASSOC);

if($_GET['oldal'] == "")
{
	$cim = "cimlap";
}
else
{
	$cim = $_GET['oldal'];
}
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
$sql = "select * from menu where fajl=\"".$cim."\"";
$sth = $dbh->prepare($sql);
$sth->execute(array());
$oldal = $sth->fetchAll(PDO::FETCH_ASSOC);
//$keres = current($oldalak);
//$keres = $oldalak['/'];

if (isset($_GET['oldal'])) {
	if (file_exists("./templates/pages/{$oldal[0]['fajl']}.tpl.php")) {
		if($oldal[0]['fajl'] == "cimlap")
		{
			$keres = $oldal;
		}
		else
		{
			$keres = $oldal[0];
		}
		
		
	}
	else { 
		$keres = $hiba_oldal;
		header("HTTP/1.0 404 Not Found");
	}
}

include('./templates/index.tpl.php'); 
?>