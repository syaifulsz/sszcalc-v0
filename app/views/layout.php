<?php

use SSZ\Calculator\Asset;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSZCALC v0</title>
    <?= Asset::css() ?>
    <?= Asset::js() ?>
</head>
<body class="bg-dark">

<?= $content ?? '' ?>

</body>
</html>