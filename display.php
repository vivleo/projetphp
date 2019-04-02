<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display</title>
</head>
<body>
    <a href="accueil.phtml">Retour</a>
</body>
</html>




<?php
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo ('Connexion échouée : ' . $e->getMessage());
    }
    $stmt = $dbh->prepare("SELECT * FROM post;");
    $posts=$stmt->fetchAll();
    foreach ($posts as $post){
        echo $post["title"];
        echo $post["content"];
    }
?>