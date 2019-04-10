<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display</title>
</head>
<body>
    <a href="accueil.php">Retour</a>
</body>
</html>


<?php
    session_start();
    $dsn = "mysql:dbname=pws;host=localhost";
    $usernamebd = "root";
    $passwordbd = "root";
    try {
        $dbh = new PDO($dsn, $usernamebd, $passwordbd);
        
    } catch (PDOException $e){
        echo ('Connexion échouée : ' . $e->getMessage());
    }
    $stmt = $dbh->prepare("SELECT * FROM post;");
    $stmt->execute();
    $posts=$stmt->fetchAll();
    foreach ($posts as $post){
        echo("<br>");
        echo "<p><a href="."displayPost.php?id=".$post["id"].">"."Titre : ".$post["title"]."</a>";
        echo("<br>");
        echo " Contenu : ".$post["content"];
        echo("<br>");
        echo("<br>");
    }
?>