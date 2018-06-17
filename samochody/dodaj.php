<?php

session_start();

if(empty($_SESSION['zalogowany'])) {
	header("Location: logowanie.php");
	exit();
}

if (isset($_POST['dodaj'])) {
  require 'db.php';

	$stmt = $pdo->prepare("INSERT INTO samochody (marka, model, rok, pojemnosc, typ_silnika, liczba_poduszek, abs, esp) VALUES (:marka, :model, :rok, :pojemnosc, :typ_silnika, :liczba_poduszek, :abs, :esp)");
	$wynik = $stmt->execute([
		'marka' => $_POST['marka'], 
		'model' => $_POST['model'],
		'rok' => $_POST['rok'],
		'pojemnosc' => $_POST['pojemnosc'],
		'typ_silnika' => $_POST['typ_silnika'],
		'liczba_poduszek' => $_POST['liczba_poduszek'],
		'abs' => $_POST['abs'],
		'esp' => $_POST['esp'],
	]);
	
    if ($wynik == true)
        header("Location: index.php?komunikat=1");
    else
        die("Operacja się nie powiodła: " . $pdo->errorInfo());
}
?>

<html>
    <head>
        <title>Dodaj</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
    <body>
        <form method="post" action="">
            <table>
                <tr>
                    <td>Marka</td>
                    <td><input type="text" name="marka" /></td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><input type="text" name="model" /></td>
                </tr>
                <tr>
                    <td>Rok</td>
                    <td><input type="text" name="rok" /></td>
                </tr>
		<tr>
		    <td>Pojemność</td>
		    <td><input type="text" name="pojemnosc" /></td>
		</tr>
		<tr>
                    <td>Liczba Poduszek</td>
                    <td>
			<select name="liczba_poduszek">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="4">4</option>
			<option value="6">6</option>
			<option value="8">8</option>
			</select>	
		    </td>
                </tr>
		<tr>
                    <td>ABS</td>
                    <td>
                   	<input type="radio" name="abs" value="tak"/>TAK
		        <input type="radio" name="abs" value="nie"/>NIE	
		    </td>
                </tr>
		<tr>
                    <td>ESP</td>
                    <td>
                        <input type="radio" name="esp" value="tak"/>TAK
                        <input type="radio" name="esp" value="nie"/>NIE
                    </td>
                </tr>
                <tr>
                    <td>Typ silnika</td>
                    <td>
                        <select name="typ_silnika">
                            <option value="benzyna">benzyna</option>
                            <option value="diesel">diesel</option>
			    <option value="hybryda">hybryda</option>
                            <option value="elektryczne">elektryczne</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="dodaj" value="Dodaj" /></td>
                </tr>
            </table>
        </form>

        <p>
            <a href="index.php">[ Powrót do listy ]</a>
        </p>
    </body>
</html>
