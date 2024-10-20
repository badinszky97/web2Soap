<?php if(isset($row)) { ?>
    <?php if($row) { ?>
        <h1>Bejelentkezett:</h1>
        Azonosító: <strong><?= $row['id'] ?></strong><br><br>
        Név: <strong><?= $row['csaladi_nev']." ".$row['uto_nev'] ?></strong>
            
            <script type="text/javascript">

            setTimeout("location.href = './';" , 1000);

            </script>
    <?php } 
    else { ?>
        <h1>A bejelentkezés nem sikerült!</h1>
        <a href="?oldal=belepes" >Próbálja újra!</a>
            <script type="text/javascript">

            setTimeout("location.href ='?oldal=belepes';" , 1000);

            </script>
    <?php } ?>
<?php } ?>
<?php if(isset($errormessage)) { ?>
    <h2><?= $errormessage ?></h2>
<?php } ?>
