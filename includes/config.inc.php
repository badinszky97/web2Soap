<?php
$ablakcim = array(
    'cim' => 'Forgalomfigyelő',
);

$fejlec = array(
    'kepforras' => 'traffic.jpg',
    'kepalt' => 'logo',
	'cim' => 'Forgalomfigyelő',
	'motto' => 'A gyorsabb közlekedésért'
);

$lablec = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'ceg' => 'Forgalomfigyelő'
);
// megjelenites magyarazat: (vendeg, bejelentkezett felhasznalo, admin)
$oldalak = array(
	'/' => array('fajl' => 'cimlap', 'szoveg' => 'Címlap', 'menun' => array(1,1,1)),
	'bemutatkozas' => array('fajl' => 'bemutatkozas', 'szoveg' => 'Bemutatkozás', 'menun' => array(1,1,1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1,0,0)),
    'admin' => array('fajl' => 'admin', 'szoveg' => 'Admin oldal', 'menun' => array(0,0,1)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilépés', 'menun' => array(0,1,1)),
    'belep' => array('fajl' => 'belep', 'szoveg' => '', 'menun' => array(0,0,0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(0,0,0)),
    'korlatozasok' => array('fajl' => 'korlatozasok', 'szoveg' => 'SOAP szerver - adatbázis', 'menun' => array(0,1,1)),
    'restfulkliens' => array('fajl' => 'restfulkliens', 'szoveg' => 'Restful Kliens', 'menun' => array(0,1,1)),
    

);

$hiba_oldal = array ('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');

$MAPPA = 'galeria/'; // './kepek/' is jó
$TIPUSOK = array ('.jpg', '.png'); // kép típusok
$MEDIATIPUSOK = array('image/jpeg', 'image/png');
$DATUMFORMA = "Y.m.d. H:i";
$MAXMERET = 500*1024;


include ("dbconnect.php");

?>