<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$keres['fajl'].'.php')) { include("./logicals/{$keres['fajl']}.php"); } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $ablakcim['cim'] . ( (isset($ablakcim['mottó'])) ? ('|' . $ablakcim['mottó']) : '' ) ?></title>
	<link rel="stylesheet" href="./styles/stilus.css" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<?php if(file_exists('./styles/'.$keres['fajl'].'.css')) { ?><link rel="stylesheet" href="./styles/<?= $keres['fajl']?>.css" type="text/css"><?php } ?>
</head>
<body>
	<header >
		<img id=felsologo src="./images/<?=$fejlec['kepforras']?>" alt="<?=$fejlec['kepalt']?>">
		<div  >
			<h1><?= $fejlec['cim'] ?></h1>		<?php if (isset($fejlec['motto'])) { ?><h2>
			<?= $fejlec['motto'] ?></h2><?php } ?> 
			<?php if(isset($_SESSION['login'])) { ?>Bejlentkezve: <strong><?= $_SESSION['csn']." ".$_SESSION['un']." (".$_SESSION['login'].")" . ($_SESSION['admin'] == 0 ? "   ->Felhasználó" : "   ->Admin") ?></strong><?php } ?>
			
		</div>
	
            <nav>
                <ul>
			<?php

			$dbh = new PDO('mysql:host='.$dbhostname.';dbname='.$dbname, $dbuser, $dbjelszo,
									array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
					$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

					$sql = "SELECT * FROM menu WHERE vendeg=1 AND parent=\"cimlap\"";
					if(isset($_SESSION['login']) && $_SESSION['admin']=0)
					{
						// felhasznalo
						$sql = "SELECT * FROM menu WHERE felhasznalo=1 AND parent=\"cimlap\"";
					}
					if(isset($_SESSION['login']) && $_SESSION['admin']=1)
					{
						// admin
						$sql = "SELECT * FROM menu WHERE felhasznalo=1 AND parent=\"cimlap\"";
					}

					$stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					$stmt->execute();
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

							echo "<li>";
							if($row['url'] == "/")
							{
								$row['url'] = ".";
							}
							else
							{
								$row['url'] = "?oldal=" . $row['url'];
							}
							echo "<a href=" . $row['url'] . ">" . $row['szoveg'] . "</a>";
							echo "</li>";
					}
			?>
			                </ul>
							</nav>

<!-- almenu -->
							<nav>
                <ul>
			<?php

			$dbh = new PDO('mysql:host='.$dbhostname.';dbname='.$dbname, $dbuser, $dbjelszo,
									array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
					$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

					$sql = "SELECT * FROM menu WHERE vendeg=1 AND parent=\"".$keres['fajl']."\" AND parent!=\"cimlap\"";
					if(isset($_SESSION['login']) && $_SESSION['admin']=0)
					{
						// felhasznalo
						$sql = "SELECT * FROM menu WHERE felhasznalo=1 AND parent=\"".$keres['fajl']."\" AND parent!=\"cimlap\"";
					}
					if(isset($_SESSION['login']) && $_SESSION['admin']=1)
					{
						// admin
						$sql = "SELECT * FROM menu WHERE felhasznalo=1 AND parent=\"".$keres['fajl']."\" AND parent!=\"cimlap\"";
					}

					$stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
					$stmt->execute();
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {

							echo "<li>";
							if($row['url'] == "/")
							{
								$row['url'] = ".";
							}
							else
							{
								$row['url'] = "?oldal=" . $row['url'];
							}
							echo "<a href=" . $row['url'] . ">" . $row['szoveg'] . "</a>";
							echo "</li>";
					}
			?>
			                </ul>
							</nav>







		</header>				
	
	<div id="wrapper">
        <div id="content">
			<?php
			$fajlnev = "";
			if($keres['fajl'] == "")
			{
				$fajlnev = "cimlap";
			}
			else
			{
				$fajlnev = $keres['fajl'];
			}
			?>
            <?php include("./templates/pages/{$fajlnev}.tpl.php"); ?>
        </div>
    </div>
    <footer>  <?php if(isset($lablec['ceg'])) { ?><?= $lablec['ceg']; ?><?php } ?> &nbsp;
        <?php if(isset($lablec['copyright'])) { ?>&copy;&nbsp;<?= $lablec['copyright'] ?> <?php } ?>
		<div id="ajax_div"></div>
    </footer>
</body>
</html>
