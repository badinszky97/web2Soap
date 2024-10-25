<h1><span>MNB Soap kliens</span></h1>


<form action=# method=post>
<label for="mainapiarfolyam">Két árfolyam napi szintje:</label>
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
<input type="date" name="datum">
<input type="submit" name=maiarfolyam value="Árfolyam letöltése">
</form>


<?php
if(isset($_POST['maiarfolyam']))
{

    $objClient = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL", array('trace' => true));
    $currrates = $objClient->GetExchangeRates(array('startDate' => "2015-09-25", 'endDate' => "2015-09-30", 'currencyNames' => "EUR,USD,CHF"))->GetExchangeRatesResult;
    $dom_root = new DOMDocument();
    $dom_root->loadXML($currrates);
    
    $searchNode = $dom_root->getElementsByTagName("Day");
    
    foreach( $searchNode as $searchNode ) {
        $date = $searchNode->getAttribute('date');
        print $date . "\n";
        $rates = $searchNode->getElementsByTagName( "Rate" ); 
        foreach( $rates as $rate ) {
            print "\t" . $rate->getAttribute('unit') . " " ;
            print $rate->getAttribute('curr');
            print "  =  ";
            print $rate->nodeValue;
            print " HUF\n";
        }
        echo "<br>";
    }
    echo "<br><br><br><br><br><br><br>";
}
?>



<?php


try {
    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
    echo "<br>GetCurrentExchangeRates()<br>";
    $tömb = (array)simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);
    echo $tömb['Day']['date']."<br>";
    print_r($tömb);


    echo "<br><br><br><br><br>GetInfo()<br>";
    $xml = simplexml_load_string($client->GetInfo()->GetInfoResult);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);

    echo "most:";
    echo sizeof($array['Currencies']['Curr']);

    echo "<label for=\"cars\">Choose a car:</label>";
    echo "<select name=\"cars\" id=\"cars\" form=\"carform\">";
    for($i=0;$i<sizeof($array['Currencies']['Curr']);$i++)
    {
        echo "<option value=\"". $array['Currencies']['Curr'][$i]."\">".$array['Currencies']['Curr'][$i]  ."</option>";
    }
        
    echo "</select>";

    //$tömb = (array)simplexml_load_string($client->GetInfo()->GetInfoResult);
    //print(  (array)$tömb['Currencies']->Curr );



    echo "<br><br><br><br><br>GetCurrencies()<br>";
    $tömb = (array)simplexml_load_string($client->GetCurrencies()->GetCurrenciesResult);
    print_r($tömb);
    echo "<br><br><br><br><br>GetDateInterval()<br>";
    $tömb = (array)simplexml_load_string($client->GetDateInterval()->GetDateIntervalResult);
    print_r($tömb);
    } catch (SoapFault $e) {
    var_dump($e);
    }

 ?>