<?php
class Lezarasok {
  
  /**
    *  @return Korlatozasok
    */
public function getlezarasok(){
  
	$eredmeny = array("hibakod" => 0,
					  "uzenet" => "",
					  "lezarasok" => Array());
	
	try {
	  $dbh = new PDO('mysql:host=localhost;dbname=forgalomSOAP','root', '',
					array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	  $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	  $sql = "select utszam, kezdet, veg, telepules, mettol, meddig, megnevezes.nev as megnevezes, mertek.nev as mertek, sebesseg from korlatozas, megnevezes, mertek WHERE korlatozas.megnevid=megnevezes.id and korlatozas.mertekid=mertek.id";
	  $sth = $dbh->prepare($sql);
	  $sth->execute(array());
	  $eredmeny['lezarasok'] = $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
	  $eredmeny["hibakod"] = 1;
	  $eredmeny["uzenet"] = $e->getMessage();
	}
	
	return $eredmeny;
  }

   /**
    *  @param int $utszam
    *  @param string $telepules
    *  @return SzurtKorlatozas
    */
    function getlezaras($utszam, $telepules){
  
      $eredmeny = array("hibakod" => 0,
                "utszam" => "",
                "kezdet" => "",
                "veg" => "",
                "telepules" => "",
                "mettol" => "",
                "meddig" => "",
                "megnevezes" => "",
                "mertek" => "",
                "sebesseg" => "");
      
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=forgalomSOAP','root', '',
              array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sql = "select utszam, kezdet, veg, telepules, mettol, meddig, megnevezes.nev as megnevezes, mertek.nev as mertek, sebesseg from korlatozas, megnevezes, mertek WHERE korlatozas.megnevid=megnevezes.id and korlatozas.mertekid=mertek.id and utszam = :utszambe and telepules = :telepulesbe";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':utszambe', $utszam);

        $sth->bindParam(':telepulesbe', $telepules);


        $sth->execute();
        $marka = $sth->fetch(PDO::FETCH_ASSOC);
        
        if(isset($marka["utszam"]))
        {
          $eredmeny["hibakod"] = 0;
        }
        else
        {
          $eredmeny["hibakod"] = -1;
        }
        

        $eredmeny["modellek"] = $marka;
        $eredmeny["utszam"] = $marka["utszam"];
        $eredmeny["kezdet"] = $marka["kezdet"];
        $eredmeny["veg"] = $marka["veg"];
        $eredmeny["telepules"] = $marka["telepules"];
        $eredmeny["mettol"] = $marka["mettol"];
        $eredmeny["meddig"] = $marka["meddig"];
        $eredmeny["megnevezes"] = $marka["megnevezes"];
        $eredmeny["mertek"] = $marka["mertek"];
        $eredmeny["sebesseg"] = $marka["sebesseg"];
      
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
  public $korlatozas;

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
  public $lezarasok;  
}


class SzurtKorlatozas {
  /**
   * @var integer
   */
  public $hibakod;

  /**
   * @var int
   */
  public $utszam;  

    /**
   * @var float
   */
  public $kezdet;  

  /**
   * @var float
   */
  public $veg;  

  /**
   * @var string
   */
  public $telepules;  

  /**
   * @var string
   */
  public $mettol;  
  /**
   * @var string
   */
  public $meddig;  

  /**
   * @var string
   */
  public $megnevezes;  

  /**
   * @var string
   */
  public $mertek;  

  /**
   * @var int
   */
  public $sebesseg;  
}
?>