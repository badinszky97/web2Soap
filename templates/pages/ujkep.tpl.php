<?php // Űrlap ellenőrzés:
    if (isset($_POST['kuld'])) {
       
        //print_r($_FILES);
        foreach($_FILES as $fajl) {
            if ($fajl['error'] == 4);   // Nem töltött fel fájlt
            elseif (!in_array($fajl['type'], $MEDIATIPUSOK))
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            elseif ($fajl['error'] == 1   // A fájl túllépi a php.ini -ben megadott maximális méretet
                        or $fajl['error'] == 2   // A fájl túllépi a HTML űrlapban megadott maximális méretet
                        or $fajl['size'] > $MAXMERET) 
                $uzenet[] = " Túl nagy állomány: " . $fajl['name'];
            else {
                $vegsohely = $MAPPA.strtolower($fajl['name']);
                if (file_exists($vegsohely))
                    $uzenet[] = " Már létezik: " . $fajl['name'];
                else {
                    move_uploaded_file($fajl['tmp_name'], $vegsohely);
                    $uzenet[] = ' Feltöltve: ' . $fajl['name'];
                }
            }
        }        
    }
    ?>
<?php
    if (!empty($uzenet))
    {
        echo '<ul>';
        foreach($uzenet as $u)
            echo "<li>$u</li>";
        echo '</ul>';
    }
?>

<?php if(isset($_SESSION['login'])) { ?>
 
 <form action=".?oldal=ujkep" method="post"
                enctype="multipart/form-data">
                <h1 >Feltöltés a galériába</h1>

        <input type="file" name="elso"  accept="image/*" required>
        </label><br>
        <input type="submit" name="kuld">

      </form>


<?php } ?>
