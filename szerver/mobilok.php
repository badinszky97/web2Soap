<?php
class Mobilok {
  
  /**
    *  @return Markak
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

   /**
    *  @param string $markakod
    *  @return Modellek
    */
    function getmodellek($utszam){
  
      $eredmeny = array("hibakod" => 0,
                "uzenet" => "",
                "markakod" => "",
                "markanev" => "",
                "modellek" => Array());
      
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=forgalomSOAP','root', '',
              array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
      
        $eredmeny["markakod"] = $utszam;
      
        //$sql = "select markaid, markanev from markak where markakod = :markakod";
        $sql = "select utszam, kezdet, veg, telepules, mettol, meddig, megnevezes.nev as megnevezes, mertek.nev as mertek, sebesseg from korlatozas, megnevezes, mertek WHERE korlatozas.megnevid=megnevezes.id and korlatozas.mertekid=mertek.id and utszam = :utszambe";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":utszambe" => $utszam));
        $marka = $sth->fetch(PDO::FETCH_ASSOC);
        $markaid = $marka["utszam"];
        $eredmeny["modellek"] = $marka;
        $eredmeny["markanev"] = $marka["markanev"];
      
      }
      catch (PDOException $e) {
        $eredmeny["hibakod"] = 1;
        $eredmeny["uzenet"] = $e->getMessage();
      }
      
      return $eredmeny;
      }


}


class Marka {
  /**
   * @var string
   */
  public $markakod;

  /**
   * @var string
   */
  public $markanev;  
}

class Markak {
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  

  /**
   * @var Marka[]
   */
  public $markak;  
}




class Modell {
  /**
   * @var string
   */
  public $modellkod;

  /**
   * @var string
   */
  public $modellnev;  
}

class Modellek {
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var string
   */
  public $uzenet;  

  /**
   * @var string
   */
  public $markakod;

  /**
   * @var string
   */
  public $markanev;  

  /**
   * @var Modell[]
   */
  public $modellek;  
}
?>