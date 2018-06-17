<?php
 $liczbaWierszy = empty($_POST['liczba_wierszy']) ? 2 :
$_POST['liczba_wierszy'];
 $liczbaKolumn = empty($_POST['liczba_kolumn']) ? 2 :
$_POST['liczba_kolumn'];
?>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html;charset=utf8">
 </head>


 <?php if(isset($_POST['kolor_tla'])): ?>
    <body style="background-color: <?=$_POST['kolor_tla'] ?>">
 <?php: else: ?>
 <body>
 <?php endif; ?>

 <table border="1">
 <?php for($i = 0; $i < $liczbaWierszy; $i++): ?>
 <tr>
 <?php for($j = 0; $j < $liczbaKolumn; $j++): ?>
     <?php if($_POST['checkbox']  == 'checked'): ?>
         <?php if ($i % 2 == 0): ?>
            <td><?=$i ?>.<?=$j ?></td>
          <?php else: ?>
            <td style="background-color: yellow;"><?=$i ?>.<?=$j ?></td>
         <?php endif; ?>
     <?php else: ?>
            <td><?=$i ?>.<?=$j ?></td>
     <?php endif; ?>
            
 <?php endfor; ?>
 </tr>
 <?php endfor; ?>
 </table>
</body>
</html>