<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <title>MOBILOK</title>
  </head>

  <?php
     $options = array(
   
   'keep_alive' => false,
    //'trace' =>true,
    //'connection_timeout' => 5000,
    //'cache_wsdl' => WSDL_CACHE_NONE,
   );
  $client = new SoapClient('http://localhost/web2/szerver/lezarasok.wsdl',$options);
  
  $markak = $client->getlezarasok();
  //$markak = $client->getlezaras(4,"Kisvárda");
  echo "<pre>";
  print_r($markak);
  echo "</pre>";

  ?>

  <body>
  </body>
</html>