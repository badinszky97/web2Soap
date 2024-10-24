<h1><span>Regisztrált korlátozások</span></h1>

<fieldset id="keresesform">
<legend>Keresés:</legend>


<table>
<form action=# method=post>
  <tr>
    <td>Útszám:</td>
    <td><input type=number min=1 max=99999 step=1 name=utszam value=1 style="width:100%"></td>
  </tr>
  <tr>
    <td>Település:</td>
    <td><input type=text name=telepulesnev></td>
  </tr>
  <tr>
    <td colspan=2><input type=submit name=keresesgomb value="Keresés" style="width:100%"></td>
  </tr>
</form>
</table>

</fieldset>

<table>
    <tr>
        <td>Útszám</td>
        <td>Kezdet</td>
        <td>Vég</td>
        <td>Település</td>
        <td>Mettől</td>
        <td>Meddig</td>
        <td>Megnevezés</td>
        <td>Mérték</td>
        <td>Sebesség</td>
    </tr>

<?php
     $options = array(
   
        'keep_alive' => false,
         //'trace' =>true,
         //'connection_timeout' => 5000,
         //'cache_wsdl' => WSDL_CACHE_NONE,
        );
 $client = new SoapClient('http://localhost/web2/szerver/lezarasok.wsdl',$options);

 $lezarasok = [];
if(isset($_POST['utszam']) && isset($_POST['telepulesnev']) && $_POST['telepulesnev'] != "" )
{
  $lezarasok = $client->getlezaras($_POST['utszam'], $_POST['telepulesnev']);
  $lezarasTomb = (array)$lezarasok;
  echo "<tr>";
 
  echo "<td>" . $lezarasTomb['utszam'] . "</td>";
  echo "<td>" . $lezarasTomb['kezdet'] . "km</td>";
  echo "<td>" . $lezarasTomb['veg'] . "km</td>";
  echo "<td>" . $lezarasTomb['telepules'] . "</td>";
  echo "<td>" . $lezarasTomb['mettol'] . "</td>";
  echo "<td>" . $lezarasTomb['meddig'] . "</td>";
  echo "<td>" . $lezarasTomb['megnevezes'] . "</td>";
  echo "<td>" . $lezarasTomb['mertek'] . "</td>";
  echo "<td>" . $lezarasTomb['sebesseg'] . "km/h</td>";



  echo "</tr>";
}
else
{
  $lezarasok = $client->getlezarasok();
  $lezarasokTomb = (array)$lezarasok;

  foreach ($lezarasokTomb["lezarasok"] as $lezaras) {
     echo "<tr>";
 
     echo "<td>" . $lezaras['utszam'] . "</td>";
     echo "<td>" . $lezaras['kezdet'] . "km</td>";
     echo "<td>" . $lezaras['veg'] . "km</td>";
     echo "<td>" . $lezaras['telepules'] . "</td>";
     echo "<td>" . $lezaras['mettol'] . "</td>";
     echo "<td>" . $lezaras['meddig'] . "</td>";
     echo "<td>" . $lezaras['megnevezes'] . "</td>";
     echo "<td>" . $lezaras['mertek'] . "</td>";
     echo "<td>" . $lezaras['sebesseg'] . "km/h</td>";
 
 
 
     echo "</tr>";
   }
}

 //$lezarasok = $client->getlezarasok();
 




?>

 
</table>
        