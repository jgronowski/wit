<?php

session_start();

if(empty($_SESSION['zalogowany'])) {
	header("Location: logowanie.php");
	exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
	require 'db.php';

    if(isset($_POST['zapisz'])) {
        // obsługa edycji rekordu
		$stmt = $pdo->prepare("UPDATE samochody SET marka = :marka, model = :model, rok = :rok, typ_silnika = :typ_silnika, pojemnosc = :pojemnosc, abs = :abs, esp = :esp, liczba_poduszek = :liczba_poduszek WHERE id = :id");
		$wynik = $stmt->execute([
			'marka' => $_POST['marka'], 
			'model' => $_POST['model'],
			'rok' => $_POST['rok'],
			'typ_silnika' => $_POST['typ_silnika'],
			'id' => $id,
			'liczba_poduszek' => $_POST['liczba_poduszek'],
			'pojemnosc' => $_POST['pojemnosc'],
			'abs' => $_POST['abs'],
			'esp' => $_POST['esp'],
		]);

		if ($wynik == true)
			header("Location: edytuj.php?id=$id&komunikat=1");
		else
			die("Operacja się nie powiodła: " . $pdo->errorInfo());
    } else {
        // wczytanie danych samochodu z bazy
        $stmt = $pdo->prepare("SELECT * FROM samochody WHERE id = :id");
		$stmt->execute(['id' => $id]);
		$wiersz = $stmt->fetch();

		if(!$wiersz)
			die("Nie znaleziono podanego samochodu!");
    }
} else {
    die("Nie podano ID");
}
?>

<html>
    <head>
        <title>Edycja</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
    <body>
        <?php if (isset($_GET['komunikat']) && $_GET['komunikat'] == 1): ?>
            <p style='color:red; font-weight:bold;'>Dane zostaly zapisane.</p>
        <?php endif; ?>

        <form method="post" action="">
            <table>
                <tr>
                    <td>Marka</td>
                    <td><input type="text" name="marka" value="<?=empty($wiersz['marka']) ? '' : $wiersz['marka'] ?>" /></td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td><input type="text" name="model" value="<?=empty($wiersz['model']) ? '' : $wiersz['model'] ?>" /></td>
                </tr>
                <tr>
                    <td>Rok</td>
                    <td><input type="text" name="rok" value="<?=empty($wiersz['rok']) ? '' : $wiersz['rok'] ?>" /></td>
                </tr>
		<tr>
                    <td>Pojemność</td>
                    <td><input type="text" name="pojemnosc" value="<?=empty($wiersz['pojemnosc']) ? '' : $wiersz['pojemnosc'] ?>"/></td>
                </tr>
                <tr>
                    <td>Liczba Poduszek</td>
                    <td>
                        <select name="liczba_poduszek">
                        <option value="1" <?=!empty($wiersz['liczba_poduszek']) && $wiersz['liczba_poduszek'] == '1' ? 'selected="selected"' : '' ?>>1</option>
                        <option value="2" <?=!empty($wiersz['liczba_poduszek']) && $wiersz['liczba_poduszek'] == '2' ? 'selected="selected"' : '' ?>>2</option>
                        <option value="4" <?=!empty($wiersz['liczba_poduszek']) && $wiersz['liczba_poduszek'] == '4' ? 'selected="selected"' : '' ?>>4</option>
                        <option value="6" <?=!empty($wiersz['liczba_poduszek']) && $wiersz['liczba_poduszek'] == '6' ? 'selected="selected"' : '' ?>>6</option>
                        <option value="8" <?=!empty($wiersz['liczba_poduszek']) && $wiersz['liczba_poduszek'] == '8' ? 'selected="selected"' : '' ?>>8</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>ABS</td>
                    <td>
                        <input type="radio" name="abs" value="tak" <?=!empty($wiersz['abs']) && $wiersz['abs'] == 'tak' ? 'checked="checked"' : '' ?>/>TAK
                        <input type="radio" name="abs" value="nie" <?=!empty($wiersz['abs']) && $wiersz['abs'] == 'nie' ? 'checked="checked"' : '' ?>/>NIE
                    </td>
                </tr>
                <tr>
                    <td>ESP</td>
                    <td>
                        <input type="radio" name="esp" value="tak" <?=!empty($wiersz['esp']) && $wiersz['esp'] == 'tak' ? 'checked="checked"' : '' ?>/>TAK
                        <input type="radio" name="esp" value="nie" <?=!empty($wiersz['esp']) && $wiersz['esp'] == 'nie' ? 'checked="checked"' : '' ?>/>NIE
                    </td>
		</tr>
                <tr>
                    <td>Typ silnika</td>
                    <td>
                        <select name="typ_silnika">
                            <option value="benzyna" <?=!empty($wiersz['typ_silnika']) && $wiersz['typ_silnika'] == 'benzyna' ? 'selected="selected"' : '' ?> >benzyna</option>
                            <option value="diesel" <?=!empty($wiersz['typ_silnika']) && $wiersz['typ_silnika'] == 'diesel' ? 'selected="selected"' : '' ?> >diesel</option>
                            <option value="hybryda" <?=!empty($wiersz['typ_silnika']) && $wiersz['typ_silnika'] == 'hybryda' ? 'selected="selected"' : '' ?> >hybryda</option>
                            <option value="elektryczne" <?=!empty($wiersz['typ_silnika']) && $wiersz['typ_silnika'] == 'elektryczne' ? 'selected="selected"' : '' ?> >elektryczne</option>

                        </select>	
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="zapisz" value="Zapisz" /></td>
                </tr>
            </table>
        </form>

        <p>
            <a href="index.php">[ Powrót do listy ]</a>
        </p>
    </body>
</html>
