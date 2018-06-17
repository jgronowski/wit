<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8">
    <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 10px;
}
    </style>
</head>

<body>
    <table style="100%">

        <?php for($i = 0; $i < 10; $i++): ?>
            <?php if ($i % 2 == 0): ?>
                <tr>
                    <td style="background-color: yellow;">
                        <p>Paragraf #<?=$i + 1 ?></p>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td>
                        <p>Paragraf #<?=$i + 1 ?></p>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endfor; ?>
    </table>
</body>

</html>
