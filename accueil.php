<?php
    session_start();
    if (!$_SESSION["connected"]){
        header("Location: index.html");
        exit;
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="add.html">Ajouter une annonce</a>
    <a href="display.php">Voir les annonces</a>
</body>
</html>