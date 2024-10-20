<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <title>MOBILOK</title>
  </head>

  <?php 
  $client = new SoapClient('http://localhost/web2/szerver/mobilok.wsdl');
  $markak = $client->getmarkak();

  ?>
    
  <body>
    <h1>MOBILOK</h1>
    <form name="markaselect" method="POST">
      <select name="marka">
        <option value="">Válasszon ...</option>
        <?php
          foreach($markak->markak as $marka)
          {
            echo '<option value="'.$marka['utszam'].'">'.$marka['telepules'].'</option>';
          }
        ?>
      </select>
    </form>
  </body>                                                          
</html>