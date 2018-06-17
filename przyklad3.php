<?php
session_start();
if(isset($_POST['zaloguj'])) {
 if(empty($_POST['uzytkownik']) || empty($_POST['haslo'])) {
     header("Location: przyklad3.php?komunikat=1");
 }
 else {
     if($_POST['uzytkownik'] == 'admin' && $_POST['haslo'] == 'tajne') {
        $_SESSION['zalogowany'] = 'tak';
        header("Location: tajne.php");
 } 
         else {
     header("Location: przyklad3.php?komunikat=2");
 }
 
}
}
?>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html;charset=utf8">
 </head>
 <body>
 <?php if(isset($_GET['komunikat']) && $_GET['komunikat'] == 1):?>
 <p style='color: red;'>Najpierw musisz sie zalogowac!</p>
 <?php elseif (isset($_GET['komunikat']) && $_GET['komunikat'] == 2):?>
 <p style='color: red;'>Nie prawidłowe hasło</p>
 <?php endif; ?>
 <form method="post" action="przyklad3.php">
 Nazwa użytkownika:
 <input type="text" name="uzytkownik" />
 <br/>
 Hasło:
 <input type="password" name="haslo" />
 <br/>
 <br/>
 <input type="submit" name="zaloguj" value="Zaloguj" />
 </form>
 </body>
</html>
