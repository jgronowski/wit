<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8">
</head>

<body>
    <?php
      $kolory = [
        'black' => '#000000', 
        'silver' => '#C0C0C0', 
        'gray' => '#808080',
        'white' => '#FFFFFF', 
        'maroon' => '#800000', 
        'red' => '#FF0000',
        'purple' => '#800080',
        'fuchsia' => '#FF00FF',
        'green' => '#008000',
        'lime' => '#00FF00',
        'olive' => '#808000',
        'yellow' => '#FFFF00',
        'navy' => '#000080',
        'blue' => '#0000FF',
        'teal' => '#008080',
        'aqua' => '#00FFFF'];
 ?>
        <ul>
        <?php foreach($kolory as $klucz => $wartosc): ?>
        <li style="color: <?=$klucz ?> ">
            <?=$klucz ?>: <strong><?=$wartosc ?></strong>
                <?php endforeach; ?>
            </li>
        </ul>
</body>

</html>