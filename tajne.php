<?php
 session_start();
 if (empty($_SESSION['zalogowany']))
 header("Location: przyklad3.php?komunikat=1");
?>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html;charset=utf8">
 </head>
 <body>
 Tajna strona.
 </body>
</html>