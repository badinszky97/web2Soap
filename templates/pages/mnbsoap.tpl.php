<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<h1><span>MNB Soap kliens</span></h1>


<table>

<form action=# method=post>
<tr><td colspan=2><label for="mainapiarfolyam">Devizapár adott napon</label></td></tr>

<tr><td>Egyik deviza: </td><td><select name="egyik" id="mainapiarfolyam">
<?php
    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
    $xml = simplexml_load_string($client->GetInfo()->GetInfoResult);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    for($i=0;$i<sizeof($array['Currencies']['Curr']);$i++)
    {
        echo "<option value=\"". $array['Currencies']['Curr'][$i]."\">".$array['Currencies']['Curr'][$i]  ."</option>";
    }
?>
</select></td></tr>

<tr><td>Másik deviza</td><td><select name="masik" id="mainapiarfolyam">
<?php
    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
    $xml = simplexml_load_string($client->GetInfo()->GetInfoResult);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    for($i=0;$i<sizeof($array['Currencies']['Curr']);$i++)
    {
        echo "<option value=\"". $array['Currencies']['Curr'][$i]."\">".$array['Currencies']['Curr'][$i]  ."</option>";
    }
?>
</select></td></tr>
<tr><td>Melyik napon</td><td><input type="date" name="datum" required></td></tr>
<tr><td colspan=2><input type="submit" name=maiarfolyam value="Árfolyam letöltése"></td></tr>
</form>
</table>

<?php
if(isset($_POST['maiarfolyam']))
{
    $devizak = $_POST['egyik'] . "," . $_POST['masik'];
    $objClient = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL", array('trace' => true));
    $currrates = $objClient->GetExchangeRates(array('startDate' => $_POST['datum'], 'endDate' => $_POST['datum'], 'currencyNames' => $devizak))->GetExchangeRatesResult;
    $dom_root = new DOMDocument();
    $dom_root->loadXML($currrates);
    
    $searchNode = $dom_root->getElementsByTagName("Day");
    
    foreach( $searchNode as $searchNode ) {
        $date = $searchNode->getAttribute('date');
        print $date . "\n<br>";
        $rates = $searchNode->getElementsByTagName( "Rate" ); 
        foreach( $rates as $rate ) {
            print "\t" . $rate->getAttribute('unit') . " " ;
            print $rate->getAttribute('curr');
            print "  =  ";
            print $rate->nodeValue;
            print " HUF\n<br>";
        }
        echo "<br>";
    }
}
?>



<table>

<form action=# method=post>
<tr><td colspan=2><label for="diagramarfolyam">Egy deviza diagramja dátumok közt</label></td></tr>

<tr><td>Egyik deviza: </td><td><select name="egyik" id="diagramarfolyam">
<?php
    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
    $xml = simplexml_load_string($client->GetInfo()->GetInfoResult);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    for($i=0;$i<sizeof($array['Currencies']['Curr']);$i++)
    {
        echo "<option value=\"". $array['Currencies']['Curr'][$i]."\">".$array['Currencies']['Curr'][$i]  ."</option>";
    }
?>
</select></td></tr>

<tr><td>Melyik naptól</td><td><input type="date" name="datumtol" required></td></tr>
<tr><td>Melyik napig</td><td><input type="date" name="datumig" required></td></tr>
<tr><td colspan=2><input type="submit" name=diagramkuld value="Árfolyam letöltése"></td></tr>
</form>
</table>






<?php
if(isset($_POST['diagramkuld']))
{
    $xek = "";
    $yok = "";
    $objClient = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL", array('trace' => true));
    $currrates = $objClient->GetExchangeRates(array('startDate' => $_POST['datumtol'], 'endDate' => $_POST['datumig'], 'currencyNames' => $_POST['egyik']))->GetExchangeRatesResult;
    $dom_root = new DOMDocument();
    $dom_root->loadXML($currrates);
    
    $searchNode = $dom_root->getElementsByTagName("Day");
    
    foreach( $searchNode as $searchNode ) {
        $date = $searchNode->getAttribute('date');
        $xek .= "\"" . $searchNode->getAttribute('date') . "\",";
        //print $date . "\n<br>";
        $rates = $searchNode->getElementsByTagName( "Rate" ); 
        foreach( $rates as $rate ) {
            //print "\t" . $rate->getAttribute('unit') . " " ;
            //print $rate->getAttribute('curr');

            $yok .= str_replace(",",".",$rate->nodeValue) . ",";


            //print "  =  ";
            //print str_replace(",",".",$rate->nodeValue);
            //print " HUF\n<br>";
        }
        //echo "<br>";
    }
    $xek = rtrim($xek, ', ');
    $yok = rtrim($yok, ', ');
    //print ($yok);
}


echo "<canvas id=\"myChart\" style=\"width:100%;max-width:600px\"></canvas>";
echo "<script>";
echo "const xValues = [" . $xek . "];";
echo "const yValues = [" . $yok . "];";
?>

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  }
});
</script>