<h1><span>MNB Soap kliens</span></h1>


<form action=# method=post>
<label for="mainapiarfolyam">Egy adott devizapár (pl. Eur-Huf, Eur-Usd, …) adott napján mennyi volt az árfolyam?</label>
<br>
<select name="egyik" id="mainapiarfolyam">
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
</select>

<select name="masik" id="mainapiarfolyam">
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
</select>
<input type="date" name="datum" required>
<input type="submit" name=maiarfolyam value="Árfolyam letöltése">
</form>


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
    echo "<br><br><br><br><br><br><br>";
}
?>


