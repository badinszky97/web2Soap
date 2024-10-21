<h1><span>Regisztrált korlátozások</span></h1>

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


?>

 
</table>
        