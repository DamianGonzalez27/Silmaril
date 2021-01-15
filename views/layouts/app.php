<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silmaril</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=East+Sea+Dokdo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&display=swap" rel="stylesheet">
    <?php 
        if(isset($view))
        { ?>
            <link rel="stylesheet" href="/app/css/<?= $view?>.css">
        <?php
        }
    ?>
</head>
<body>
    <?= $this->section('content') ?>
    <?php 
        if(isset($view))
        { ?>
            <script src="/app/js/<?= $view;?>.js"></script>
        <?php
        }
    ?>
</body>
</html>