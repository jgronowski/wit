<?php

session_start();

if (isset($_POST['zaloguj'])) {                                                                                
  if ($_SESSION['invalid_atempt'] >= 4) {                                                                      
    $komunikat = "Możliwość logowania została zablokowana. Spróbuj za " . session_cache_expire() . " minut";
  } else {                                                                                                     
    try {                                                                                                      
      require 'db.php';      
                                                                                                               
      $stmt = $pdo->prepare("SELECT * FROM uzytkownicy WHERE login = :login AND haslo = :haslo");
      $stmt->execute(['login' => $_POST['login'], 'haslo' => $_POST['haslo']]); 
      $wynik = $stmt->fetch();                                                                                 
                                                                                                               
      if($wynik) {                                                                                             
        $_SESSION['zalogowany'] = 'tak';                                                                       
        $_SESSION['id'] = $wiersz['id'];                                                                       
        $_SESSION['invalid_atempt'] = 0;                                                                       
        header("Location: index.php");                                                                         
      } else {                                                                                                 
        $komunikat = "Wprowadzono zły login lub hasło.";                        
        $_SESSION['invalid_atempt']++;                                                                         
      }                                                                                                        
    }                                                                                                          
    catch(PDOException $e)                                                                                     
    {                                                                                                          
      echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();        
    }                                                                                                          
  }                                                                                                            
} 
?>

<html>
    <head>
        <title>Logowanie</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
    <body>
		<?php if(!empty($komunikat)): ?>
			<p style="font-weight: bold; color: red;"><?=$komunikat ?></p>
		<?php endif; ?>
		
        <form method="post" action="">
            <table>
                <tr>
                    <td>Login</td>
                    <td><input type="text" name="login" /></td>
                </tr>
                <tr>
                    <td>Hasło</td>
                    <td><input type="password" name="haslo" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="zaloguj" value="Zaloguj" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
