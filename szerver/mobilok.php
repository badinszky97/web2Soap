<?php
class Lezarasok {
  
  /**
    *  @return Korlatozas
    */
  public function getmarkak(){
  
	$eredmeny = array("hibakod" => 0,
					  "uzenet" => "",
					  "markak" => Array());
	
	try {
	  $dbh = new PDO('mysql:host=localhost;dbname=forgalomSOAP','root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	  $sql = "select utszam, kezdet, veg, telepules, mettol, meddig, megnevezes.nev as megnevezes, mertek.nev as mertek, sebesseg from korlatozas, megnevezes, mertek WHERE korlatozas.megnevid=megnevezes.id and korlatozas.mertekid=mertek.id";
	  $sth = $dbh->prepare($sql);
	  $sth->execute(array());
	  $eredmeny['markak'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
	  $eredmeny["hibakod"] = 1;
	  $eredmeny["uzenet"] = $e->getMessage();
	}
	
	return $eredmeny;
  }
}


class Korlatozas {
  /**
   * @var string
   */
  public $markakod;

  /**
   * @var string
   */
  public $markanev;  
}

class Korlatozasok {
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  

  /**
   * @var Korlatozas[]
   */
  public $markak;  
}
?>