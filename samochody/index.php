<?php

session_start();

if(isset($_GET['logout'])) {
  session_destroy();
  header("Location: logowanie.php");
  }

if(empty($_SESSION['zalogowany'])) {
	header("Location: logowanie.php");
	exit();
}


$dane = [];
require 'db.php';
foreach($pdo->query('SELECT * FROM samochody ORDER BY marka, model') as $wiersz)
	$dane[] = $wiersz;
?>

<html>
	<head>
		<title>Lista</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	</head>
	<body>
		<?php if(isset($_GET['komunikat'])): ?>
			<p style='color:red; font-weight:bold;'>
                <?php if($_GET['komunikat'] == 1): ?>
                    Samochod zostal dodany.
                <?php elseif($_GET['komunikat'] == 2): ?>
                    Samochod zostal usuniety.
                <?php endif; ?>
			</p>
		<?php endif; ?>
		
		<p>
			<a href="dodaj.php">[ Dodaj samochod ]</a>
      <a href="index.php?logout">[ Wyloguj sie ]</a>
		</p>
		<table>
			<tr>
				<th>Marka</th>
				<th>Model</th>
				<th>Rok</th>
				<th>Operacje</th>
			</tr>
            
			<?php foreach($dane as $d): ?>
            <tr>
                <td><?=$d['marka'] ?></td>
                <td><?=$d['model'] ?></td>
                <td><?=$d['rok'] ?></td>
                <td>
                    <a href="szczegoly.php?id=<?=$d['id'] ?>">szczegóły</a>
                    <a href="edytuj.php?id=<?=$d['id'] ?>">edytuj</a>
                    <a href="usun.php?id=<?=$d['id'] ?>" onclick="return confirm('Czy jestes pewien ze chcesz usunac ten rekord z bazy?')">usuń</a>
                </td>
            </tr>
            <?php endforeach; ?>
		</table>
		
	</body>
</html>
