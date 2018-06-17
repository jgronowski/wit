<?php

session_start();

if(empty($_SESSION['zalogowany'])) {
	header("Location: logowanie.php");
	exit();
}

if(isset($_GET['id'])) { 
	require 'db.php';
	$stmt = $pdo->prepare("DELETE FROM samochody WHERE id = :id"); 
	$wynik = $stmt->execute(['id' => $_GET['id']]); 
	
	if($wynik == true) 
		header("Location: index.php?komunikat=2"); 
	else 
		echo "<p style='color:red; font-weight:bold;'>Usuwanie nie powiodlo sie.</p>";
} 